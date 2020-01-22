function getPlayers(type) {


    ajaxDisplay("backendPlayer.php?type=" + type);


}

function ajaxDisplay(endpoint) {

	let xhr = new XMLHttpRequest();
	xhr.open("GET", endpoint, true);
	xhr.send();

	xhr.onreadystatechange = function() {
		console.log(this);
		if(this.readyState == this.DONE) {
			if(xhr.status == 200) {

                let resultData = JSON.parse(xhr.responseText);
                
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

function displayPeople(resultData) {

    let clear = document.querySelector("#players");
    while(clear.hasChildNodes()) {
        clear.removeChild(clear.lastChild);
    }

    for(let i = 0; i < resultData.length; i++) {

        let r = document.createElement("tr");
        
        let name = document.createElement("td");
        name.innerHTML = resultData[i].first_name + " " + resultData[i].last_name;
        
        let fg = document.createElement("td");
        fg.innerHTML = resultData[i].fg_pct;

        let fg3 = document.createElement("td");
        fg3.innerHTML = resultData[i].fg3_pct;
        fg3.className = "fg3";


        let ft = document.createElement("td");
        ft.innerHTML = resultData[i].ft_pct;
        ft.className = "ft";

        let min = document.createElement("td");
        min.innerHTML = resultData[i].min;
        min.className = "min";


        let pts = document.createElement("td");
        pts.innerHTML = resultData[i].pts;

        let b = document.createElement("td");
        let button = document.createElement("button");

        button.className = "delete-button";
        button.innerHTML = "Delete";
        button.setAttribute("onclick", "deletePlayer(" + resultData[i].api_id + ")");
        button.setAttribute("id", resultData[i].api_id);


        b.appendChild(button);

        r.appendChild(name);
		r.appendChild(fg);
		r.appendChild(fg3);
        r.appendChild(ft);
        r.appendChild(min);
        r.appendChild(pts);
        r.append(b);
    
        document.querySelector("#players").appendChild(r);

        
    }
}

function deletePlayer(id) {

    document.getElementById(id).parentElement.parentElement.remove();


    let endpointURL = "database.php?id=" + id +
    "&type=delete"; 

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