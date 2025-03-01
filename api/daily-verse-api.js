const API_KEY = `81f316c5f31960d155555818b8d0a59c`; // Fill in with your own key.
const verse = document.querySelector(`#verse-content`);
const verseRef = document.querySelector(`#verse`);

const BIBLE_ID = `61fd76eafa1577c2-02`;
    const VERSES = [
    `JER.29.11`,
    `PSA.23`,
    `1COR.4.4-8`,
    `PHP.4.13`,
    `JHN.3.16`,
    `ROM.8.28`,
    `ISA.41.10`,
    `PSA.46.1`,
    `GAL.5.22-23`,
    `HEB.11.1`,
    `2TI.1.7`,
    `1COR.10.13`,
    `PRO.22.6`,
    `ISA.40.31`,
    `JOS.1.9`,
    `HEB.12.2`,
    `MAT.11.28`,
    `ROM.10.9-10`,
    `PHP.2.3-4`,
    `MAT.5.43-44`,
    `ECC.3.11`,
    `1JN.1.9`,
    `1CO.13.4-7`,
    `JHN.14.6`,
    `ROM.12.2`,
    `JHN.16.33`,
    `JHN.14.27`,
    `1PE.5.7`,
    `1CO.10.31`,
    `1CO.16.14`,
    `2CO.5.17`,
    `1CO.15.58`,
    `1CO.16.13`,
    `1CO.15.33`,
    `1CO.14.40`,
    `1CO.15.57`,
    `1CO.15.10`,
    `1CO.15.2`,
    `1CO.15.1`,
    `1CO.14.33`,
    `1CO.13.11`,
    `1CO.13.8`,
    `1CO.13.6`,
    `1CO.13.5`,
    `1CO.13.3`,
    `1CO.13.2`,
    `1CO.13.1`,
    `1CO.12.31`,
    `1CO.12.30`,
    `1CO.12.29`,
    `1CO.12.28`,
    `1CO.12.27`,
    `1CO.12.26`,
    `1CO.12.25`,
    `1CO.12.24`,
    `1CO.12.23`,
    `1CO.12.22`,
    `1CO.12.21`,
    `1CO.12.20`,
    `1CO.12.19`,
    `1CO.12.18`,
    `1CO.12.17`,
    `1CO.12.16`,
    `1CO.12.15`,
    `1CO.12.14`,
    `1CO.12.13`,
    `1CO.12.12`,
    `1CO.12.11`,
    `1CO.12.10`,
    `1CO.12.9`,
    `1CO.12.8`,
    `1CO.12.7`,
    `1CO.12.6`,
    `1CO.12.5`,
    `1CO.12.4`,
    `1CO.12.3`,
    `1CO.12.2`,
    `1CO.12.1`,
    `1CO.11.34`,
    `1CO.11.33`,
    `1CO.11.32`,
    `1CO.11.31`,
    `1CO.11.30`,
    `1CO.11.29`,
    ];

    const verseIndex = new Date().getDate();
    const verseID = VERSES[verseIndex];    
    
    getResults(verseID).then((data) => {
    const passage = data.passages[0];
    verseRef.innerHTML = `<span><i>${passage.reference}</i></span>`;
    verse.innerHTML = `<div class="text eb-container">${passage.content}</div>`;
    });

function getResults(verseID) {
return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener(`readystatechange`, function () {
    if (this.readyState === this.DONE) {
        const { data, meta } = JSON.parse(this.responseText);

        _BAPI.t(meta.fumsId);
        resolve(data);
    }
    });

    xhr.open(
    `GET`,
    `https://api.scripture.api.bible/v1/bibles/${BIBLE_ID}/search?query=${verseID}`
    );
    xhr.setRequestHeader(`api-key`, API_KEY);

    xhr.onerror = () => reject(xhr.statusText);

    xhr.send();
});
}