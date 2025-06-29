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
        </div>

    </div>
</main>

<!-- Reemplazar CLIENT_ID por tu client id proporcionado al crear la app desde el developer dashboard) -->
<script src="https://www.paypal.com/sdk/js?client-id=Ad5YE_dgL6D2DFIGeHSdOYfpWtToVMpnpfCp1pITz_UYqFOu2NtemnCVYxtfgwTuHIU9zjmNiZy2AhuV&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
 
<script>
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
 
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
 
            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';
 
            // Or go to another URL:  actions.redirect('thank_you.html');
            
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
 
  initPayPalButton();
</script>