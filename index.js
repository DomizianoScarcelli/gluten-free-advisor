const express = require("express");
const app = express();
app.listen(3000, () => {
    console.log("Daje sto a senti tutto quello che me devi dimme");
})
app.use(express.static('public'));