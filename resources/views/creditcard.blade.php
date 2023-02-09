<!DOCTYPE html>
<html>
<head>
    <title>Finalização de Compra</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<main>
    <input type="hidden" id="mercado-pago-public-key" value="{{ $publicKey }}">

    <section class="shopping-cart dark">
        <div class="container container__cart">
            <div class="block-heading">
                <h2>Carrinho de Compras</h2>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="items">
                            <div class="product">
                                <div class="info">
                                    <div class="product-details">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-4 product-detail">
                                                <h5>Produto</h5>
                                                <div class="product-info">
                                                    <p><b>Descrição: </b><span id="product-description">Um Livro</span><br>
                                                        <b>Preço:</b> R$ <span id="unit-price">100</span></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 product-detail">
                                                <label for="quantity"><h5>Quantidade</h5></label>
                                                <input type="number" id="quantity" value="1" min="1" class="form-control">
                                            </div>
                                            <div class="col-md-4 payment-type">
                                                <label for="quantity"><h5>Forma de Pagamento</h5></label>
                                                <select class="form-control" name="payment-type" id="payment-type">
                                                    <option value="1">Boleto</option>
                                                    <option value="2">Cartão de Crédito</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="summary">
                            <h3>Carrinho</h3>
                            <div class="summary-item"><span class="text">Subtotal</span><span class="price" id="cart-total"></span></div>
                            <button class="btn btn-primary btn-lg btn-block" id="checkout-btn">Finalizar Pagamento</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="payment-form dark">
        <div class="container__paymentticket">
            <form action="/process-payment-ticket" method="post">
                @csrf
                <input type="hidden", name="value" value="100">
                <h2>Dados do Boleto</h2>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" id="email" value="test@test.com" class="form-control" placeholder="usuario@dominio.com">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" name="name" id="name" value="Test" class="form-control" placeholder="João">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="lastname">Sobrenome:</label>
                            <input type="text" name="lastname" id="lastname" value="User" class="form-control" placeholder="da Silva">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="lastname">CPF:</label>
                            <input type="number" name="cpf" id="cpf" value="19119119100" class="form-control" placeholder="19119119100">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="cep">CEP (apenas números):</label>
                            <input type="number" name="cep" id="cep" value="06233200" class="form-control" placeholder="01234567">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-10">
                        <div class="form-group">
                            <label for="streetName">Endereço:</label>
                            <input type="text" name="streetName" id="streetName" value="Av. das Nações Unidas" class="form-control" placeholder="Av. das Nações Unidas">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="streetNumber">Número:</label>
                            <input type="number" name="streetNumber" id="streetNumber" value="3003" class="form-control" placeholder="3003">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label for="neighborhood">Bairro:</label>
                        <input type="text" name="neighborhood" id="neighborhood" value="Bonfim" class="form-control" placeholder="Bonfim">
                    </div>
                    <div class="col-4">
                        <label for="city">Cidade:</label>
                        <input type="text" name="city" id="city" value="Osasco" class="form-control" placeholder="Osasco">
                    </div>
                    <div class="col-4">
                        <label for="city">Estado:</label>
                        <select id="federal_unit" name="federal_unit" class="form-control">
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP" selected>São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                            <option value="EX">Estrangeiro</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col">
                        <a id="go-back">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 10 10" class="chevron-left">
                                <path fill="#009EE3" fill-rule="nonzero" id="chevron_left" d="M7.05 1.4L6.2.552 1.756 4.997l4.449 4.448.849-.848-3.6-3.6z"></path>
                            </svg>
                            Voltar ao Carrinho
                        </a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Gerar Boleto</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="container__payment">
            <div class="block-heading">
                <h2>Pagamento com Cartão de Crédito</h2>
            </div>
            <div class="form-payment">
                <div class="products">
                    <h2 class="title">Indice</h2>
                    <div class="item">
                        <span class="price" id="summary-price"></span>
                        <p class="item-name">Livro x <span id="summary-quantity"></span></p>
                    </div>
                    <div class="total">Total<span class="price" id="summary-total"></span></div>
                </div>
                <div class="payment-details">
                    <form id="form-checkout">
                        @csrf
                        <h3 class="title">Dados do Comprador</h3>
                        <div class="row">
                            <div class="form-group col">
                                <input id="form-checkout__cardholderEmail" name="cardholderEmail" type="email" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5">
                                <select id="form-checkout__identificationType" name="identificationType" class="form-control"></select>
                            </div>
                            <div class="form-group col-sm-7">
                                <input id="form-checkout__identificationNumber" name="docNumber" type="text" class="form-control"/>
                            </div>
                        </div>
                        <br>
                        <h3 class="title">Detalhes do Cartão</h3>
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <input id="form-checkout__cardholderName" name="cardholderName" type="text" class="form-control"/>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="input-group expiration-date">
                                    <div id="form-checkout__expirationDate" class="form-control h-40"></div>
                                </div>
                            </div>
                            <div class="form-group col-sm-8">
                                <div id="form-checkout__cardNumber" class="form-control h-40"></div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div id="form-checkout__securityCode" class="form-control h-40"></div>
                            </div>
                            <div id="issuerInput" class="form-group col-sm-12 hidden">
                                <select id="form-checkout__issuer" name="issuer" class="form-control"></select>
                            </div>
                            <div class="form-group col-sm-12">
                                <select id="form-checkout__installments" name="installments" type="text" class="form-control"></select>
                            </div>
                            <div class="form-group col-sm-12">
                                <input type="hidden" id="amount" />
                                <input type="hidden" id="description" />
                                <div id="validation-error-messages">
                                </div>
                                <br>
                                <button id="form-checkout__submit" type="submit" class="btn btn-primary btn-block">Pagar</button>
                                <br>
                                <p id="loading-message">Carregando, aguarde...</p>
                                <br>
                                <a id="go-back-card">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 10 10" class="chevron-left">
                                        <path fill="#009EE3" fill-rule="nonzero" id="chevron_left" d="M7.05 1.4L6.2.552 1.756 4.997l4.449 4.448.849-.848-3.6-3.6z"></path>
                                    </svg>
                                    Voltar ao Carrinho
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart dark">
        <div class="container container__result">
            <div class="block-heading">
                <h2>Resultado do Pagamento</h2>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="items product info product-details">
                            <div class="row justify-content-md-center">
                                <div class="col-md-4 product-detail">
                                    <div class="product-info">
                                        <div id="fail-response">
                                            <br/>
                                            <p class="text-center font-weight-bold">Algo de Errado</p>
                                            <p id="error-message" class="text-center"></p>
                                            <br/>
                                        </div>

                                        <div id="success-response">
                                            <br/>
                                            <p><b>ID: </b><span id="payment-id"></span></p>
                                            <p><b>Status: </b><span id="payment-status"></span></p>
                                            <p><b>Detalhe: </b><span id="payment-detail"></span></p>
                                            <br/>
                                        </div>

                                        <p><a href="{{ url('/') }}">Voltar</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>
