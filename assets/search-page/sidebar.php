<!--Codice HMTL della sidebar contenete i vari filtri di ricerca-->
<div class="sidebar-outside-container">
    <div class="sidebar">
        <div class="sidebar-inside-container">
            <p class="sidebar-element-title">Servizi del risorante</p>
            <?php
            $array = array('Consegna a domicilio', 'Da asporto', 'Consumazione sul posto', 'Cucina separata');
            foreach ($array as $value) {
                $encodedValue = str_replace(' ', '-', $value);
                echo "
                <div class='checkbox'>
                    <input type='checkbox' name='servizi-ristorante' id='$encodedValue'>
                    <label for='$encodedValue' class='checkbox-label'>$value</label> <br>
                </div>
                ";
            }
            ?>
        </div>

        <div class="sidebar-inside-container">
            <p class="sidebar-element-title">Prezzo</p>
            <?php
            $array = array('Economico', 'Nella media', 'Raffinato');
            foreach ($array as $value) {
                $encodedValue = str_replace(' ', '-', $value);
                echo "
                <div class='checkbox'>
                    <input type='checkbox' name='servizi-ristorante' id='$encodedValue'>
                    <label for='$encodedValue' class='checkbox-label'>$value</label> <br>
                </div>
                ";
            }
            ?>
        </div>

        <div class="sidebar-inside-container">
            <p class="sidebar-element-title">Piatti</p>
            <?php
            $array = array('Pizza', 'Pasta', 'Panini', 'Dolci', 'Sushi', 'Risotto', 'Gelato');
            foreach ($array as $value) {
                echo
                "
                <div class='checkbox'>
                    <input type='checkbox' name='servizi-ristorante' id='{$value}'>
                    <label for='{$value}' class='checkbox-label'>{$value}</label> <br>
                </div>
                ";
            }
            ?>
        </div>

        <div class="sidebar-inside-container">
            <p class="sidebar-element-title">Restrizioni alimentari</p>
            <?php
            $array = array('Per vegetariani', 'Per vegani');
            foreach ($array as $value) {
                $encodedValue = str_replace(' ', '-', $value);
                echo "
                    <div class='checkbox'>
                        <input type='checkbox' name='servizi-ristorante' id='$encodedValue'>
                        <label for='$encodedValue' class='checkbox-label'>$value</label> <br>
                    </div>
                    ";
            }
            ?>
        </div>
    </div>
</div>