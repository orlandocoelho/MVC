$(document).ready(function() {
    $("#form").validate({
        rules: {
            name: {
                required: true,
                minlength: 10
            },
            mail: {
                required: true,
                email: true
            },
            login: {
                required: true,
                minlength: 3
            },
            pass: {
                required: true,
                minlength: 10
            },
            reppass: {
                required: true,
                equalTo: "#pass"
            }
        },
        messages: {
            name: {
                required: "Este campo não pode ser vazio!",
                minlength: "Digite o nome completo!"
            },
            mail: {
                required: "Este campo é obrigatório!",
                email: "Digite um email valido!"
            },
            login: {
                required: "Digite um login!",
                minlength: "Minimo 3 caracteres!"
            },
            pass: {
                required: "Digite uma senha!",
                minlength: "Minimo 10 caracteres!"
            },
            reppass: {
                required: "Digite a mesma senha digita anteriormente!",
                equalTo: "Senhas não são iguais"
            }
        }
    });
});