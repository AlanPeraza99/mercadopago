<body>
   <!-- Add step #2 -->
   <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
   <script>
      window.Mercadopago.setPublishableKey("TEST-ba6a6a62-02c0-4b3a-9714-8c6b572bae8b");
    
       
   </script>
<form action="/process_payment" method="post" id="paymentForm">
   <h3>Detalles del comprador</h3>
     <div>
       <div>
         <label for="email">E-mail</label>
         <input id="email" name="email" type="text" value="test@test.com"/>
       </div>
       <div>
         <label for="docNumber">Número de documento</label>
         <input id="docNumber" name="docNumber" data-checkout="docNumber" type="text"/>
       </div>
     </div>
   <h3>Detalles de la tarjeta</h3>
     <div>
       <div>
         <label for="cardholderName">Titular de la tarjeta</label>
         <input id="cardholderName" data-checkout="cardholderName" type="text">
       </div>
       <div>
         <label for="">Fecha de vencimiento</label>
         <div>
           <input type="text" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
             onselectstart="return false" onpaste="return false"
             oncopy="return false" oncut="return false"
             ondrag="return false" ondrop="return false" autocomplete=off>
           <span class="date-separator">/</span>
           <input type="text" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear"
             onselectstart="return false" onpaste="return false"
             oncopy="return false" oncut="return false"
             ondrag="return false" ondrop="return false" autocomplete=off>
         </div>
       </div>
       <div>
         <label for="cardNumber">Número de la tarjeta</label>
         <input type="text" id="cardNumber" data-checkout="cardNumber"
           onselectstart="return false" onpaste="return false"
           oncopy="return false" oncut="return false"
           ondrag="return false" ondrop="return false" autocomplete=off>
       </div>
       <div>
         <label for="securityCode">Código de seguridad</label>
         <input id="securityCode" data-checkout="securityCode" type="text"
           onselectstart="return false" onpaste="return false"
           oncopy="return false" oncut="return false"
           ondrag="return false" ondrop="return false" autocomplete=off>
       </div>
       <div id="issuerInput">
         <label for="issuer">Banco emisor</label>
         <select id="issuer" name="issuer" data-checkout="issuer"></select>
       </div>
       <div>
         <label for="installments">Cuotas</label>
         <select type="text" id="installments" name="installments"></select>
       </div>
       <div>
         <input type="hidden" name="transactionAmount" id="transactionAmount" value="100" />
         <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
         <input type="hidden" name="description" id="description" />
         <br>
         <button type="submit">Pagar</button>
         <br>
       </div>
   </div>
 </form>
</body>
<script>
      doSubmit = false;
document.getElementById('paymentForm').addEventListener('submit', getCardToken);
function getCardToken(event){
   event.preventDefault();
   if(!doSubmit){
       let $form = document.getElementById('paymentForm');
       window.Mercadopago.createToken($form, setCardTokenAndPay);
       return false;
   }
};

function setCardTokenAndPay(status, response) {
   if (status == 200 || status == 201) {
       let form = document.getElementById('paymentForm');
       let card = document.createElement('input');
       card.setAttribute('name', 'token');
       card.setAttribute('type', 'hidden');
       card.setAttribute('value', response.id);
       form.appendChild(card);
       doSubmit=true;
       form.submit();
   } else {
       alert("Verify filled data!\n"+JSON.stringify(response, null, 4));
   }
};
</script>