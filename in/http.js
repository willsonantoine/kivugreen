//Url base
const url_base = "http://dbsystem-api1.test";
const id_auth = "6363531ba90ce6363531ba90d9";

// getToken
const access_token = localStorage.getItem("access_token");

var access_files = url_base;

async function HttpPost(route, data = {}, id_error_pan = null) {

    if (id_error_pan != null) {

        $("#" + id_error_pan).attr("disabled", true); 

        document.getElementById(id_error_pan).innerHTML = `<i class="fa fa-spinner fa-spin"></i>Traitement en cours`;
    }

    data["parms"] = id_auth;

    return await axios.post(url_base + route, data, {

        headers: {
            'Authorization': `Bearer ${access_token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });
}

async function HttpGet(route, data = {}) {

    return await axios.get(url_base + route, data, {
        headers: {
            'Authorization': `Bearer ${access_token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }
    });
}

