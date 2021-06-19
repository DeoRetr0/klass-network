<html>
<head>
    <title></title>
</head>
<body style="background-color: #161625; font-family: Helvetica">
    <div class="module"
        style="background-color: #3B404F; color:#FFFEFE; font-size:12px; line-height:20px; padding:16px 16px 16px 16px; text-align:Center;">
        <div class="row justify-content-center">
            <div class="module">
                <div class="card">
                    <div class="card-header">Verificação de E-mail</div>
                    <div class="card-body">
                        @if (session('resent'))
                        <div>
                            {{ __('Um novo link foi enviado ao seu e-mail!') }}
                        </div>
                        @endif
                        <a href="http://127.0.0.1:8000/reset-password/{{$token}}">Clique aqui para redefinir a
                            senha.</a>
                        <p>Este é um pedido de redefinição de senha para a conta do Klass.</p>
                        <p style="font-weight: bold">Se você não fez essa solicitação, favor não clicar no link acima.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>