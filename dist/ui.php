<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UI</title>
    <script src="https://kit.fontawesome.com/ea2635cacf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.min.css">
    <script src="js/index.js"></script>
</head>
<body>
    <section class="section" id="ui">
        <div class="container">
            <div class="section__inner">
                <a href="" class="btn btn--def">Кнопка 1</a>
                <a href="" class="btn btn--nodef">Кнопка 2</a>
                <a href="" class="btn btn--cat">Категория 1<i class="fas fa-angle-right"></i></a>
            </div>
        </div>
    </section>
    <section class="section" id="ui-inputs">
        <div class="container">
            <div class="section__inner">
                <div class="inp">
                    <input type="text" placeholder="Поле ввода" class="input-text">
                    <!-- <ul class="precept__list">
                        <li class="valid-true">Только кирилица</li>
                        <li class="valid-false">Не менее 2-х букв</li>
                        <li class="valid-false">Не меболеенее 45-ти букв</li>
                    </ul> -->
                </div>
                <div class="inp focus">
                    <input type="text" placeholder="Поле ввода(в фокусе)" class="input-text">
                </div>
                <div class="inp valid-true focus">
                    <input type="text" placeholder="Поле ввода(Валидное)" class="input-text">
                </div>
                <div class="inp valid-false focus">
                    <input type="text" placeholder="Поле ввода(Не валидное)" class="input-text">
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="ui-moreinputs">
        <div class="container">
            <div class="section__inner">
                <div class="inp">
                    <textarea name="" id="" cols="30" rows="10" class="input-text"></textarea>
                </div>
                <div class="inp datalist">
                    <input type="text" class="input-text" list="data-id">
                    <i class="fas fa-angle-down"></i>
                    <datalist id="data-id">
                        <option value="Текст1">
                        <option value="Текст2">
                    </datalist>
                </div>
                <div class="inp radio">
                    <input type="radio" name="radio" id="radio1">
                    <label for="radio1"><span>1</span></label>
                </div>
                <div class="inp radio">
                    <input type="radio" name="radio" id="radio2">
                    <label for="radio2"><span>2</span></label>
                </div>
                <div class="inp radio">
                    <input type="radio" name="radio" id="radio3">
                    <label for="radio3"><span>3</span></label>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="ui-messages">
        <div class="container">
            <div class="section__inner">
                <div class="popap message" data-message-type="error" data-message-text="">
                    <div class="popap__inner">
                        Ошибка!
                    </div>
                    <a class="btn--popap-close"></a>
                </div>
                <div class="popap message" data-message-type="success" data-message-text="">
                    <div class="popap__inner">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, nisi.
                    </div>
                    <a class="btn--popap-close"></a>
                </div>
                <div class="popap message" data-message-type="info" data-message-text="">
                    <div class="popap__inner">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, nisi.
                    </div>
                    <a class="btn--popap-close"></a>
                </div>
                <div class="popap confirm" data-confirm-text="">
                    <div class="popap__inner">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam assumenda doloribus exercitationem. Amet, blanditiis eum.
                    </div>
                    <div class="buttons">
                        <a class="btn btn--def">Confirm</a>
                        <a class="link link--def">Cancel</a>
                    </div>
                    <a class="btn--popap-close"></a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .section__inner{
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }
        .section__inner  a, div{
            margin-right: 25px;
            margin-bottom: 25px;
        }
    </style>
    
</body>
</html>