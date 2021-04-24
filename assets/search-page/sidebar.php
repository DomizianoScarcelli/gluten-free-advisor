<!--Codice HMTL della sidebar contenete i vari filtri di ricerca-->
<div class="sidebar-outside-container">
    <div class="sidebar">
        <div class="sidebar-inside-container">
            <p class="sidebar-element-title">Servizi del risorante</p>
            <div class="checkbox">
                <input type="checkbox" name="servizi-ristorante" id="consegna-domicilio">
                <label for="consegna-domicilio" class="checkbox-label">Consegna a domicilio</label> <br>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="servizi-ristorante" id="asporto">
                <label for="asporto" class="checkbox-label">Da asporto</label> <br>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="servizi-ristorante" id="consumazione-posto">
                <label for="consumazione-posto" class="checkbox-label">Consumazione sul posto</label> <br>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="servizi-ristorante" id="cucina-separata">
                <label for="cucina-separata" class="checkbox-label">Cucina separata</label> <br>
            </div>
        </div>

        <div class="sidebar-inside-container">
            <p class="sidebar-element-title">Prezzo</p>
            <div class="checkbox">
                <input type="checkbox" name="servizi-ristorante" id="economico">
                <label for="economico" class="checkbox-label">Economico</label> <br>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="servizi-ristorante" id="nella-media">
                <label for="nella-media" class="checkbox-label">Nella media</label> <br>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="servizi-ristorante" id="raffinato">
                <label for="raffinato" class="checkbox-label">Raffinato</label> <br>
            </div>
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
            <div class="checkbox">
                <input type="checkbox" name="servizi-ristorante" id="per-vegetariani">
                <label for="per-vegetariani" class="checkbox-label">Per vegetariani</label> <br>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="servizi-ristorante" id="per-vegani">
                <label for="per-vegani" class="checkbox-label">Per vegani</label> <br>
            </div>
        </div>
    </div>
</div>