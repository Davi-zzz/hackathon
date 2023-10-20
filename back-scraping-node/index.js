const express = require("express");
const puppeteer = require("puppeteer");
const app = express();
const port = 3000;

app.get("/", async (req, res) => {
    //TODO: 
    await scrapper();
    res.send("test");
});

app.listen(port, () => {
    console.log("running on http://localhost:3000");
});

async function scrapper() {
    const browser = await puppeteer.launch({
        headless: false,
    });
    const page = await browser.newPage();

    console.log("line 1");

    await page.goto(
        "https://www.unitins.br/portaltransparencia/folha-de-pagamento"
    );

    console.log("line 2");

    await page.setViewport({ width: 1080, height: 1024 });

    console.log("line 3");

    await page.$("#TipoAno");
    await page.select("#TipoAno", "2023");

    console.log("line 4");

    await page.$("#tipoMes");
    await page.select("#tipoMes", "06");

    console.log("line 5");

    await page.$("#TipoPesquisa");
    await page.select("#TipoPesquisa", "Nome");

    await page.$("#busca");
    await page.type("#busca", "Fredson");

    const searchButton = await page.$("button.btn.btn-default");

    if (searchButton) {
        await searchButton.click();
    } else {
        console.log("cannot find results");
    }

    console.log("finded the fredson");

    const csvButton = await page.$("a.dt-button.buttons-csv.buttons-html5");

    if (csvButton) {
        //is downloading on C:/Users/<username>/Downloads/Demonstrativo de pagamento (1).csv
        await csvButton.click();
    } else {
        console.log("cannot find results");
    }

    console.log();

    await browser.close();
}
