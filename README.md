# LTW
 
Visto che l'applicazione sfrutta PHP nell'index per caricare in maniera dinamica alcuni elementi, per vedere correttamente il sito bisogna installare XAMPP.

Per avviare il server da VSCODE bisogna installare l'estensione PHP Server, fare click destro nel corpo di "Index.php" e cliccare su "PHP Server: Serve project".

Contenuto dei vari file:
-Index.php è il file indice in cui è presente l'home page.
-search-page.php è la pagina in cui vengono mostrati i risultati della ricerca. 

In 'assets' si trovano i vari elementi che vengono caricati poi nelle altre pagine tramite php. Assets presenta delle sottocartelle che indicano in che pagina quel contenuto viene caricato.

In css si trovano i fogli di stili delle varie pagine, con dei nomi abbastanza autoesplicativi. Nella sottocartella /mobile si trovano i css destinati ai dispositivi mobile in modo da aumentare la responsiveness del sito.

In js si trovano gli script Javascript:
 - **addRestaurant.js**: è lo script che viene eseguito quando l'utente compila il form per aggiungere un nuovo ristorante;
 - **homeSearch.js**: è lo script che viene eseguito quando viene effettuata una ricerca nella homepage;
 - **mobileResponsiveness.js**: è lo script che viene eseguito per rendere alcuni elementi responsive quando ci si trova su dispositivi mobile (ciò che non si può fare con solo il css);
 - **research.js**: è stato scritto per effettuare la ricerca rapida all'interno della home page ma non viene utilizzato in quanto non sarebbe implementabile se gli elementi verrebbero ricercati all'interno di un database, come dovrebbe avvenire.
