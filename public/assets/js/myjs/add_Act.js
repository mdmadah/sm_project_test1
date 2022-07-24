document.querySelector('#input_sw').addEventListener('change', (event) => {
    showUST();
    console.log("hey2");
});

document.querySelector('#input_ust').addEventListener('change', (event) => {
    showUS();
});

function showUS() {
    let input_ust = document.querySelector("#input_ust");
    console.log("hey3");
    let url = "{{ url('/api/US') }}?input_ust=" + input_ust.value;
    console.log(url);
    fetch(url)
        .then(response => response.json())
        .then(result => {

            console.log(result);
            console.log(result[0]);
            let input_us = document.querySelector("#input_us");
            for (let item of result) {
                let option = document.createElement("option");
                option.text = item['us_name'];
                option.value = item['us_id'];

                input_us.appendChild(option);
            }

        });

}

function showCompa() {

    let input_sw = document.querySelector("#input_sw");
    console.log("hey2");
    let url = "{{ url('/api/company') }}?input_sw=" + input_sw.value;
    console.log(url);
    fetch(url)
        .then(response => response.json())
        .then(result => {
            console.log(result);
            let input_company = document.getElementById("input_company");
            for (let item of result) {
                input_company.value = item.organ_name_th;
                break;
            }
        });
}

function showUST() {
    let input_sw = document.querySelector("#input_sw");
    console.log(input_sw.value);
    let url = "{{ url('/api/sw/USType') }}?input_sw=" + input_sw.value;
    console.log(url);
    fetch(url)
        .then(response => response.json())
        .then(result => {

            console.log(result);
            console.log(result[0]['ust_name']);

            console.log(result.length.length);
            let input_ust = document.querySelector("#input_ust");
            for (let item of result) {
                let option = document.createElement("option");
                option.text = item['ust_name'];
                option.value = item['ust_id'];

                input_ust.appendChild(option);
            }

            showCompa();

        });

}
