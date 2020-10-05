//API Search Function
const searchITunesMusicAPI = (event) => {
    event.preventDefault(); //Prevent Form Refresh
    const searchTerm = document.querySelector("section:nth-of-type(1) > form > input[type=search]").value; //Search Query
    
    //AJAX Fetch
    fetch( `../api/?term=${searchTerm.replace(/ /g, "+")}` )
        .then( response => response.json() ) //Convert JSON Response to JSON Object
        .then( data => {

            //Remove DOM for Previous Main Section Results
            const previousSearchResults = document.querySelectorAll(".search-results");
            for (const previousSearchResult of previousSearchResults) {
                previousSearchResult.remove();
            }

            for (const result of data.results) {
                if (result.kind == "song") { //Display song Results
                    const mainSection = document.querySelector("body > main"); //Get DOM for Main Section
                    const section = document.createElement("section"); //Create DOM for section
                    const h2 = document.createElement("h2"); //Create DOM for section
                    const img = document.createElement("img"); //Create DOM for section
                    const audio = document.createElement("audio"); //Create DOM for section
                    const audioSource = document.createElement("source"); //Create DOM for section
                    const p = document.createElement("p"); //Create DOM for section
                    const spanTrackName = document.createElement("span"); //Create DOM for section
                    const strongTrackName = document.createElement("strong"); //Create DOM for section
                    const spanTrackPrice = document.createElement("span"); //Create DOM for section
                    const strongTrackPrice = document.createElement("strong"); //Create DOM for section
                    const spanCollectionName = document.createElement("span"); //Create DOM for section
                    const strongCollectionName = document.createElement("strong"); //Create DOM for section
                    const spanCountry = document.createElement("span"); //Create DOM for section
                    const strongCountry = document.createElement("strong"); //Create DOM for section
                    const spanLink = document.createElement("span"); //Create DOM for section
                    const aLink = document.createElement("a"); //Create DOM for section
                    section.classList.add("search-results"); //Add class to section
                    h2.textContent = `${result.artistName}`; //Add title to h2
                    img.setAttribute("src", `${result.artworkUrl100}`); //Add src to img
                    audio.setAttribute("controls", ""); //Add controls to audio
                    audioSource.setAttribute("src", `${result.previewUrl}`); //Add src to audio source
                    audioSource.setAttribute("type", "audio/mpeg"); //Add type to audio source
                    audio.appendChild(audioSource); //Add audio source to audio
                    strongTrackName.textContent = `${result.trackName}`; //Add title to strong
                    spanTrackName.appendChild(strongTrackName); //Add title to span
                    strongTrackPrice.textContent = `${result.trackPrice} ${result.currency}`; //Add title to strong
                    spanTrackPrice.appendChild(strongTrackPrice); //Add title to span
                    strongCollectionName.textContent = `${result.collectionName}`; //Add title to strong
                    spanCollectionName.appendChild(strongCollectionName); //Add title to span
                    strongCountry.textContent = `${result.country}`; //Add title to strong
                    spanCountry.appendChild(strongCountry); //Add title to span
                    aLink.textContent = "Listen on Apple Music"; //Add title to strong
                    aLink.setAttribute("href", `${result.trackViewUrl}`); //Add href to link
                    aLink.setAttribute("target", "_blank"); //Add href to link
                    spanLink.appendChild(aLink); //Add title to span
                    p.appendChild(spanTrackName); //Add span to p
                    p.appendChild(spanTrackPrice); //Add span to p
                    p.appendChild(spanCollectionName); //Add span to p
                    p.appendChild(spanCountry); //Add span to p
                    p.appendChild(spanLink); //Add span to p
                    section.appendChild(h2); //Add h2 to section
                    section.appendChild(img); //Add h2 to section
                    section.appendChild(audio); //Add h2 to section
                    section.appendChild(p); //Add p to section
                    mainSection.appendChild(section); //Append Main Section
                }
            }
        })
        .catch( error => {
            console.log(error);
        }
    );
}

//Add Event Listener to Form
const searchForm = document.querySelector("section:nth-of-type(1) > form#search-form");
searchForm.addEventListener("submit", searchITunesMusicAPI);
searchForm.addEventListener("input", searchITunesMusicAPI);