const express = require("express");
const puppeteer = require("puppeteer");
const app = express();
const port = 3000;

app.use(express.json());
app.get("/", async (req, res) => {
    //TODO:
    console.log(req.body);
    // await scrapper(req.body.data['keys']);
    const result = await scrapper(req.body.keys);
    res.send(result);
});

app.listen(port, 'localhost', () => {
    console.log("running on http://26.66.209.67:3000");
});

async function scrapper(searchString) {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    console.log("line 1");

    page.on("download", (download) => {
        console.log(`Download started: ${download}`);

        // Create a Promise to track the download completion
        const downloadCompletePromise = new Promise(async (resolve, reject) => {
            try {
                // Wait for the 'response' event associated with the download URL
                const response = await page.waitForResponse(
                    (response) => response.url() === download.url()
                );

                // Save the downloaded file
                const filename = download;
                const buffer = await response.buffer();
                fs.writeFileSync(filename, buffer);

                console.log(`Download completed: ${filename}`);
                resolve();
            } catch (error) {
                reject(error);
            }
        });

        // Wait for the download completion
        downloadCompletePromise
            .then(() => {
                console.log("Download completed successfully.");
            })
            .catch((error) => {
                console.error("Download failed:", error);
            });
    });

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
    await page.type("#busca", `${searchString}`);

    const searchButton = await page.$("button.btn.btn-default");

    if (searchButton) {
        await searchButton.click();
    } else {
        console.log("cannot find results");
    }

    console.log("finded the fredson");

    await page.waitForNavigation({ waitUntil: "domcontentloaded" });

    await page.waitForSelector("#example");

    // Extract data from the table
    const data = await page.evaluate(() => {
        const rows = Array.from(document.querySelectorAll("#example tbody tr"));

        return rows.map((row) => {
            const columns = row.querySelectorAll("td");
            return {
                matricula: columns[0].textContent.trim(),
                nomeCompleto: columns[1].textContent.trim(),
                funcao: columns[2].textContent.trim(),
                lotacaoAtual: columns[3].textContent.trim(),
                vinculo: columns[4].textContent.trim(),
                totalVencimento: columns[5].textContent.trim(),
                descontoIRRF: columns[6].textContent.trim(),
                descontoPrevidencia: columns[7].textContent.trim(),
                descontosDiversos: columns[8].textContent.trim(),
                salarioLiquido: columns[9].textContent.trim(),
                referencia: columns[10].textContent.trim(),
            };
        });
    });

    console.log(data);

    await browser.close();
    return data;
}
