const setValidation = () => {
    const inputs = document.querySelectorAll(".setvalidation");
    inputs.forEach((el, i) => {
        el.addEventListener("input", function () {
            resetInputs(this);
            return false;
        });
        el.addEventListener("paste", function () {
            resetInputs(this);
            return false;
        });
        el.addEventListener("focus", function () {
            if (el.value) {
                el.classList.add("focus");
            }
            return false;
        });
        el.addEventListener("blur", function () {
            el.classList.remove("focus");
            completeInput(el, validation(item));
            return false;
        });
    });
};

function validation(el) {
    let val = el.children[0].value;
    let precept = validLets[el.children[0].getAttribute("data-valid-id")];
    let give = { reg: false, min: false, max: false, fun: false, all: false };
    precept.reg.test(val) ? (give.reg = true) : (give.reg = false);
    precept.min <= val.length ? (give.min = true) : (give.min = false);
    precept.max >= val.length ? (give.max = true) : (give.max = false);
    if (precept.f() !== undefined && precept.f() !== null) {
        precept.f() ? (give.fun = true) : (give.fun = false);
    } else {
        give.fun = true;
    }
    for (let key in give) {
        give.all = true;
        if (!give[key]) {
            give.all = false;
            break;
        }
    }
    return give;
}

function resetInputs(item) {
    let retobj = validation(item);
    let ret = [];
    for (key in retobj) {
        ret.push(retobj[key]);
    }
    for (let i = 0; i < item.children[1].children.length; i++) {
        item.children[1].children[i].classList.remove(
            "valid-true",
            "valid-false"
        );
        let cond = `valid-${ret[i]}`;
        item.children[1].children[i].classList.add(cond);
    }
    completeInput(item, retobj);
}

function completeInput(item, retobj) {
    item.classList.remove("valid-true", "valid-false");
    if (retobj.all) {
        item.classList.add("valid-true");
    } else {
        item.classList.add("valid-false");
    }
}

function isUnique(col) {
    let txt = document.querySelector(`input[name='inpr--${col}']`).value;
    let ret;
    if (txt.length) {
        let val = {
            text: txt,
            col: `u_${col}`,
        };
        $.ajax({
            url: "server/user.php",
            method: "post",
            data: `isunique=${JSON.stringify(val)}`,
            async: false,
            success: function (data) {
                res = data;
            },
        });
        return res;
    }
}

function register() {
    let inputs = document.querySelectorAll(".setvalidation");
    let cond = true;
    inputs.forEach((el) => {
        if (!validation(el).all) {
            cond = false;
        }
        completeInput(el, validation(el));
    });

    let now = new Date();
    let date = new Date(
        document.querySelector("input[name='inpr--date']").value
    );
    if (Math.round((now - date) / (24 * 60 * 60 * 1000)) < 5110 /* 14 лет */) {
        cond = false;
        // Дословно, берём указанную дату и отнимаем её от сегодняшней, если результат в днях, менее 14 лет, запрещаем рег
    }
    if (cond) {
        let result = {
            name: inputs[0].children[0].value,
            email: inputs[1].children[0].value,
            login: inputs[2].children[0].value,
            pass: inputs[3].children[0].value,
            pass2: inputs[4].children[0].value,
            phone: inputs[5].children[0].value,
            date: inputs[6].children[0].value,
        };
        let json = JSON.stringify(result);
        $.ajax({
            url: "server/user.php",
            method: "post",
            data: `reg_info=${json}`,
            success: function (data) {
                console.log(data);
                if (data == "00true") {
                    // 00 - это проверка на уникальность email и login
                    document.location.href = "profile.php";
                }
            },
        });
    }
}
function login() {
    let obj = {
        login: document.querySelector(`input[name='linp--login']`).value,
        pass: document.querySelector(`input[name='linp--pass']`).value,
    };
    if (obj.login.length > 0 && obj.pass.length > 0) {
        let json = JSON.stringify(obj);
        $.ajax({
            url: "server/user.php",
            method: "post",
            data: `log_info=${json}`,
            success: function (data) {
                if (data !== "0") {
                    setTimeout(() => {
                        document.location.href = "profile.php";
                    }, 1000);

                    message({
                        target: "message",
                        type: "success",
                        text: "Вы успешно авторизировались",
                    });
                } else {
                    message({
                        target: "message",
                        type: "error",
                        text: "Неправильно указаны логин и/или пароль",
                    });
                }
            },
        });
    } else {
        message({
            target: "message",
            type: "error",
            text: "Поле логин и/или пароля не заполнены",
        });
    }
}

function logout() {
    this.addEventListener("click", function () {
        $.ajax({
            url: "server/user.php",
            data: "logout=true",
            type: "POST",
            success: function (data) {
                if (data == "true") {
                    document.location.href = "index.php";
                }
            },
        });
    });
}

function udpateUserInfo() {
    let allinputs = document.querySelectorAll(".input-text");
    let inputs = document.querySelectorAll(".setvalidation");
    let cond = true;
    inputs.forEach((el) => {
        if (!validation(el).all) {
            cond = false;
        }
        completeInput(el, validation(el));
    });

    if (cond) {
        uploadFile(document.querySelector("#edit--image"));
        let send = [];
        allinputs.forEach((el) => {
            send.push(el.value);
        });
        let json = JSON.stringify(send);
        $.ajax({
            url: "server/user.php",
            method: "post",
            data: `edit=${json}`,
            success: function (data) {
                if (data == "true") {
                    document.location.href = "profile.php";
                }
            },
        });
    }
}

function uploadFile(input) {
    let fileinput = input;
    if (fileinput.value) {
        let fd = new FormData();
        fd.append("img", $(fileinput).prop("files")[0]);
        $.ajax({
            url: "server/images.php",
            data: fd,
            processData: false,
            contentType: false,
            type: "POST",
            success: function (data) {
                if (data == "true") {
                    document.location.href = "profile.php";
                }
            },
        });
    }
}

function itemUpload(itemsimagesinput) {
    let preview = document.querySelector(".imgpreviews");
    itemsimagesinput.addEventListener("change", function () {
        if (
            preview.children.length < 10 &&
            itemsimagesinput.files.length < 10
        ) {
            if (itemsimagesinput.value) {
                for (let i = 0; i < itemsimagesinput.files.length; i++) {
                    let fd = new FormData();
                    fd.append("img", $(itemsimagesinput).prop("files")[i]);
                    upload(fd);
                }
            }
        }
    });

    function upload(fd) {
        $.ajax({
            url: "server/itemsrc.php",
            data: fd,
            processData: false,
            contentType: false,
            type: "POST",
            success: function (data) {
                if (data !== "false") {
                    preview.innerHTML += `<div class="img"><img src="${data}" alt=""><a class="del"></a></div>`;
                    newLstnr();
                }
            },
        });
    }

    function newLstnr() {
        document.querySelectorAll(".img .del").forEach((el) => {
            el.addEventListener("click", function () {
                $.ajax({
                    url: "server/itemsrc.php",
                    data: `del=${el.previousSibling.getAttribute("src")}`,
                    type: "POST",
                    success: function (data) {
                        el.parentNode.classList.add("predel");
                        setTimeout(() => {
                            el.parentNode.remove();
                        }, 500);
                    },
                });
            });
        });
    }

    if (document.querySelectorAll(".img .del")) {
        newLstnr();
    }
}

function addNewItem(form) {
    let date = new Date();
    let item = {
        name: document.querySelector('.inp input[name="item_name"]').value,
        text: document.querySelector('.inp textarea[name="item_text"]').value,
        images: "",
        cats: "",
        show_name: document.querySelector("#itemtab .checkbox input").checked,
        date:
            date.getFullYear() +
            "-" +
            (date.getMonth() < 10
                ? "0" + (date.getMonth() + 1)
                : date.getMonth() + 1) +
            "-" +
            (date.getDate() < 10 ? "0" + date.getDate() : date.getDate()),
    };
    document.querySelectorAll(".imgpreviews .img img").forEach((el) => {
        item.images += el.getAttribute("src") + ";";
    });
    document.querySelectorAll(".inp.dls input").forEach((el) => {
        item.cats += el.value.length > 0 ? el.value + ";" : "";
    });

    let cond = true;
    for (let key in item) {
        if (item[key].length == 0) {
            cond = false;
        }
    }

    if (cond && form == "add") {
        $.ajax({
            url: "server/itemsrc.php",
            data: "newpost=" + JSON.stringify(item),
            type: "POST",
            success: function (data) {
                console.log(data);
                if (data == "true") {
                    message({
                        target: "message",
                        type: "success",
                        text: "Заявление добавленно!",
                    });
                    setTimeout(() => {
                        document.location.href = "index.php";
                    }, 1000);
                }
            },
        });
    }

    if (cond && form == "edit") {
        let itemid = window.location.search.split("=")[1];
        $.ajax({
            url: "server/itemsrc.php",
            data: "editpost=" + JSON.stringify(item) + "&item=" + itemid,
            type: "POST",
            success: function (data) {
                if (data == "true") {
                    message({
                        target: "message",
                        type: "success",
                        text: "Данные обновленны",
                    });
                    setTimeout(() => {
                        document.location.href = "viewitem.php?id=" + itemid;
                    }, 1000);
                }
            },
        });
    }
}

function clearInputs() {
    document.querySelectorAll(".inp .input-text").forEach((el) => {
        el.value = "";
    });

    document.querySelectorAll(".imgpreviews .img img").forEach((el) => {
        el.parentNode.classList.add("predel");
        setTimeout(() => {
            el.parentNode.remove();
        }, 500);
        $.ajax({
            url: "server/itemsrc.php",
            data: `del=${el.getAttribute("src")}`,
            type: "POST",
        });
    });
}

function disItem() {
    message({
        target: 'message',
        type:  'confirm',
        text: 'Удалить заявку? Вышу заявку сможет восстановить только администратор<br><div class="buttons"><a class="btn btn--def confdel" onclick="del()">Удалить</a><a class="back" onclick="window.location.reload()">Отмена</a></div>'
    });
}

function del() {
    let itemid = ( window.location.search.split('=')[1] );
    $.ajax({
        url: 'server/itemsrc.php',
        data: 'disabledpost=' + itemid,
        type: 'POST',
        success: function(data) {
            console.log(data)
            if(data == 'true') {
                message({
                    target: "message",
                    type: "success",
                    text: "Заявка удаленна",
                });
                setTimeout(() => {
                    document.location.href = 'profile.php';
                }, 1000)
            }
        }
    })
}

function editStatus(item) {
    console.log('1123')
    let itemid = ( window.location.search.replace('?', '').split('=')[1] );
    $.ajax({
        url: 'server/itemsrc.php',
        type: 'POST',
        data: 'status=' + item.checked + '&itemid=' + itemid,
        success: function(data) {
            if(data == 'true') {
                window.location.reload();
            }
        }
    })
}

function setNotify() {

}

function getNotify() {
    var eventSource = new EventSource('server/notify.php');

    eventSource.onopen = function(e) {
        console.log("Открыто соединение");
    };
    eventSource.onmessage = function(e) {
        console.log("Сообщение: " + e.data);
    };
    eventSource.onerror = function(e) {
        if (this.readyState == EventSource.CONNECTING) {
            console.log("Ошибка соединения, переподключение");
        } else {
            console.log("Состояние ошибки: " + this.readyState);
        }
    };
}

function readNotify() {
    $.ajax({

    })
}

const dopPsevdoUi = () => {
    const inp = document.querySelectorAll(".inp");
    if (inp.length > 0) {
        const input = document.querySelectorAll(".inp .input-text");
        input.forEach((item, i) => {
            item.addEventListener("focus", function () {
                inp[i].classList.add("focus");
            });
            item.addEventListener("blur", function () {
                inp[i].classList.remove("focus");
            });
        });
    }
};

let messageid = 0;
const message = (mess) => {
    messageid++;
    document.querySelector(".message__form").innerHTML += `
        <div class="popap ${mess.target}" data-message-type="${
        mess.type
    }" data--message-id="${messageid}" style="order: ${10 - messageid};">
            <div class="popap__inner">${mess.text}</div>
            <a class="btn--popap-close" data--close-id="${messageid}"></a>
        </div>
    `;
    setTimeout(() => {
        document
            .querySelector(`.popap[data--message-id='${messageid}']`)
            .classList.add("show");
    }, 50);

    document.querySelectorAll(".btn--popap-close").forEach((el) => {
        el.addEventListener("click", function () {
            close(el);
        });
    });

    function close(el) {
        let messagediv = document.querySelector(
            `.popap[data--message-id='${el.getAttribute("data--close-id")}']`
        );
        messagediv.classList.remove("show");
        setTimeout(() => {
            messagediv.style = "height: 0; margin: 0; padding: 0;";
        }, 400);
        setTimeout(() => {
            let del = document.querySelector(
                `.popap[data--message-id='${el.getAttribute(
                    "data--close-id"
                )}']`
            );
            del.parentNode.removeChild(del);
        }, 1000);
    }
};

const defaultSlider = (sett) => {
    const slider = document.querySelector(sett.target);
    let cont;
    if (sett.hasOwnProperty("controlls")) {
        cont = document.querySelectorAll(sett.controlls);
    } else if (sett.hasOwnProperty("thumbs")) {
        cont = document.querySelectorAll(sett.thumbs);
    }
    let active = 0;
    cont.forEach((el) => {
        el.addEventListener("click", function () {
            if (el.classList.contains("left")) {
                console.log("123");
            }
            if (
                el.classList.contains("right") &&
                active !== slider.children.length - 2
            ) {
                active++;
            } else if (el.classList.contains("left") && active > 0) {
                active--;
            } else {
                active = el.getAttribute("data--slider-active");
            }

            move(sett.line);
        });
    });

    function move(line) {
        for (let i = 0; i < slider.children.length; i++) {
            slider.children[i].style = `left: ${
                i * line
            }px; transform: translateX(${-line * active}px);`;
        }
    }

    for (let i = 0; i < slider.children.length; i++) {
        slider.children[i].style = `left: ${i * sett.line}px;`;
    }
};

function searchall() {
    let value = document.querySelector('#searchall .inp input').value;
    document.querySelector('#searchall .inp a').setAttribute('href', `allitems.php?search=${value}`);
}

function modal(toggle) {
    let mod = document.querySelector(`.modal[data--modal="${toggle.getAttribute('data--toggle-modal')}"]`);
    mod.classList.toggle('show');
}

document.addEventListener("DOMContentLoaded", function () {
    dopPsevdoUi();
    setValidation();
    getNotify();

    let imageinput = document.querySelector("#edit--image");
    let menu_items = document.querySelectorAll(".nav .link");
    let additemimg = document.querySelector('#additemimg');

    if( additemimg ) {
        itemUpload(additemimg);
    }

    if (imageinput) {
        let preview = document.querySelector("#imgprev");
        imageinput.addEventListener("change", function (evt) {
            const [file] = this.files;
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.add("show");
            }
        });
    }

    menu_items.forEach((el) => {
        el.addEventListener("click", function () {
            menu_items.forEach((leave) => {
                leave.classList.remove("current");
            });
            el.classList.add("current");
        });

        el.classList.remove("current");
        let pathname = window.location.pathname.split("/");
        if (pathname[pathname.length - 1] == el.getAttribute("href")) {
            el.classList.add("current");
        }

        if (el.getAttribute("data--pathnames-current") != null) {
            let pn = el
                .getAttribute("data--pathnames-current")
                .split(";")
                .forEach((path) => {
                    if (pathname[pathname.length - 1] == path) {
                        el.classList.add("current");
                    }
                });
        }
    });

    document.addEventListener('click', function(e) {
        let mods = document.querySelectorAll('.modal.show')
        if( mods.length > 0 ) {

            if( !e.target.closest('.modal') && !e.target.closest('a[data--toggle-modal]') ) {
                mods.forEach((el) => {
                    el.classList.remove('show');
                })
            }
        }
    })
});
