<main class="registro">
    <h1 class="registro__heading"><?php echo $titulo; ?></h1>
    <p class="registro__descripcion"><?php echo $descripcion; ?></p>

    <div class="paquetes__grid">
        <div data-aos="<?php aos_animacion(); ?>" class="paquete">

            <h3 class="paquete__nombre">Pase gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
            </ul>

            <p class="paquete__precio">$0</p>

            <form action="/finalizarRegistro/gratis" method="POST">
                <input type="submit" class="paquetes__submit" type="submit" value="Seleccionar pase gratis">
            </form>

        </div>

        <div data-aos="<?php aos_animacion(); ?>" class="paquete">

            <h3 class="paquete__nombre">Pase presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a grabaciones</li>
                <li class="paquete__elemento">Camisa del evento</li>
                <li class="paquete__elemento">Comida y bebida</li>
            </ul>

            <p class="paquete__precio">$199</p>

            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>

        <div data-aos="<?php aos_animacion(); ?>" class="paquete">

            <h3 class="paquete__nombre">Pase virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a grabaciones</li>
            </ul>

            <p class="paquete__precio">$49</p>

            <div id="smart-button-container">
              <div style="text-align: center;">
                  <div id="paypal-button-container-virtual"></div>
              </div>
            </div>
        </div>

    </div>
</main>

<!-- Reemplazar CLIENT_ID por tu client id proporcionado al crear la app desde el developer dashboard) -->
<script src="https://www.paypal.com/sdk/js?client-id=Ad5YE_dgL6D2DFIGeHSdOYfpWtToVMpnpfCp1pITz_UYqFOu2NtemnCVYxtfgwTuHIU9zjmNiZy2AhuV&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>

 
<script> 
  // PRIMER BOTON DE 149 DOLARES
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":199}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            const datos = new FormData()
            datos.append('paquete_id', orderData.purchase_units[0].description); // ID del paquete presencial
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id); // ID del pago


            fetch('/finalizarRegistro/pagar', {
              method: 'POST',
              body: datos
            })
            .then( respuesta => respuesta.json())
            .then( resultado => {
              if(resultado.resultado) {
                actions.redirect(window.location.href = '/finalizarRegistro/conferencias');
              }
            })
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container'); // cierre PRIMER BOTON DE 149 DOLARES
      //segundo boton de 49 dolares
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"2","amount":{"currency_code":"USD","value":49}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            const datos = new FormData()
            datos.append('paquete_id', orderData.purchase_units[0].description); // ID del paquete presencial
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id); // ID del pago


            fetch('/finalizarRegistro/pagar', {
              method: 'POST',
              body: datos
            })
            .then( respuesta => respuesta.json())
            .then( resultado => {
              if(resultado.resultado) {
                actions.redirect(window.location.href = '/finalizarRegistro/conferencias');
              }
            })
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container-virtual'); //cierre del segundo boton de 49 dolares

    }
 
  initPayPalButton();
</script>