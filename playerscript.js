typeKey = "/json/c96szad4jv69";
url = "https://www.fantasyfootballnerd.com/service/";
basket = "https://www.balldontlie.io/api/v1/players";
ball = "https://www.balldontlie.io/api/v1/players";

function displayStats() {
    
    ajaxDisplay(ball);

}


function ajaxDisplay(endpoint) {

	let xhr = new XMLHttpRequest();
	xhr.open("GET", endpoint, true);
	xhr.send();

	xhr.onreadystatechange = function() {
		console.log(this);
		if(this.readyState == this.DONE) {
			if(xhr.status == 200) {

                let resultData = JSON.parse( xhr.responseText );
                
                displayPeople(resultData);
			}
			else {
				// Error
				console.log("AJAX error");
				console.log(xhr.status);
			}

		}

	}

}

document.querySelector("#search-form").onsubmit = function(event) {

    event.preventDefault();
    let searchInput = document.querySelector("#search-id").value.trim();

    if(document.querySelector("#search-id").value.trim().length == 0) {
        event.preventDefault();
        console.log('hi');
        document.querySelector("#error").innerHTML = "Please enter a player name.";
        return;
    }

    searchEndpoint = ball + "?search=" + searchInput;

    ajaxDisplay(searchEndpoint);

}


function displayPeople(d) {

    let clear = document.querySelector("#players");
    while(clear.hasChildNodes()) {
        clear.removeChild(clear.lastChild);
    }

    let resultData = d.data;

    for(let i = 0; i < resultData.length; i++) {

        let r = document.createElement("tr");
        
        let firstName = document.createElement("td");
        firstName.innerHTML = resultData[i].first_name;
        
        let lastName = document.createElement("td");
        lastName.innerHTML = resultData[i].last_name;

        let position = document.createElement("td");
        position.innerHTML = resultData[i].position;
        position.className = "position";

        let team = document.createElement("td");
        team.innerHTML = resultData[i].team.full_name;
        team.className = "team";

        let b = document.createElement("td");
        let button = document.createElement("button");

        button.className = "add-button";
        button.innerHTML = "Add";
        button.setAttribute("onclick", "addtoPlayer(" + resultData[i].id + ", " 
                                                      + "'" + resultData[i].first_name + "'" + ", " 
                                                      + "'" + resultData[i].last_name + "'" + ", "
                                                      + "'" + resultData[i].position + "'" + ", "
                                                      + "'" + resultData[i].team.full_name + "'" + ")");
        b.appendChild(button);


        r.appendChild(firstName);
		r.appendChild(lastName);
		r.appendChild(position);
        r.appendChild(team);
        r.appendChild(b);
    
        document.querySelector("#players").appendChild(r);

        
    }
}

function addtoPlayer(id, first, last, pos, team) {

    url = "https://www.balldontlie.io/api/v1/season_averages?season=2019&player_ids[]=" + id;

    let xhr = new XMLHttpRequest();
	xhr.open("GET", url, true);
	xhr.send();

	xhr.onreadystatechange = function() {
		console.log(this);
		if(this.readyState == this.DONE) {
			if(xhr.status == 200) {
				console.log( JSON.parse( xhr.responseText ) );

                let resultData = JSON.parse( xhr.responseText );

                if(resultData.data.length == 0) {
                    alert("No data associated with this player for the 2019 season.  Unable to add player");
                    return;
                }
                
                databasePeople(resultData, id, first, last, pos, team);
			}
			else {
				// Error
				console.log("AJAX error");
				console.log(xhr.status);
			}

		}

	}
}

function databasePeople(resultData, id, first, last, pos, team) {

    let endpointURL = "database.php?firstName=" + first +
                        "&id=" + id + 
                        "&lastName=" + last +
                        "&position=" + pos +
                        "&team=" + team +
                        "&ast=" + resultData.data[0].ast + 
                        "&fg3_pct=" + resultData.data[0].fg3_pct +
                        "&fg_pct=" + resultData.data[0].fg_pct +
                        "&ft_pct=" + resultData.data[0].ft_pct +
                        "&min=" + resultData.data[0].min +
                        "&pts=" + resultData.data[0].pts +
                        "&reb=" + resultData.data[0].reb +
                        "&type=add";
                        
    console.log(endpointURL);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', endpointURL, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                if(xhr.responseText.length > 0) {
                    alert( xhr.responseText );
                }
            } else {
                alert('AJAX Error.');
                console.log(xhr.status);
            }
        }
    }
    xhr.send();



}
