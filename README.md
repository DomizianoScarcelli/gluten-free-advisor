# LTW

Visto che l'applicazione sfrutta PHP nell'index per caricare in maniera dinamica alcuni elementi, per vedere correttamente il sito bisogna installare XAMPP.

Per avviare il server da VSCODE bisogna installare l'estensione PHP Server, fare click destro nel corpo di "index.php" e cliccare su "PHP Server: Serve project".

Contenuto dei vari file:

**index.php** è il file indice in cui è presente l'home page.

**search-page.php** è la pagina in cui vengono mostrati i risultati della ricerca.

**ristoranti.php** contiene il codice che genera dinamicamente la pagina del ristorante cercato.

**about.php** è la pagina che riassume la mission del progetto e permette di contattare gli autori.

In css si trovano i fogli di stili delle varie pagine, con dei nomi abbastanza autoesplicativi.

In js si trovano gli script Javascript:

-   **addRestaurant.js**: è lo script che viene eseguito quando l'utente compila il form per aggiungere un nuovo ristorante;
-   **search.js**: è lo script che viene eseguito quando viene effettuata una ricerca nella homepage;
-   **vueElements.**: sono presenti tutti gli oggetti di Vue.js;
-   **addReview.js**: è lo script che viene eseguito all'invio del form per aggiungere una nuova recensione;
-   **editRestaurantInfo.js**: è lo script che viene eseguito all'invio del form per aggiornare i dati del ristorante;
-   **slideshow.js**: è lo script che viene eseguito per permettere il funzionamento dello slideshow sulla pagina del ristorante.

Il sito permette il catalogo e la ricerca di ristoranti senza glutine italiani.
È possibile ricercare un ristorante tramite nome, via o descrizione. La ricerca può avvenire nella homepage o nella pagina dove vengono mostrati i risultati di ricerca (search-page).
Il concetto alla base del sito è quello di permettere agli utenti di aggiungere nuovi ristoranti e modificare le info dei ristoranti pre-esistenti.
