const addMoreTask = document.querySelector('add');
let url = "{{ url('/api/team') }}";
var row = 0;
var option = '';
var element = document.getElementById("add");
element.addEventListener("click", getteam);

function getteam() {
    // console.log("75151515");
    // data = result;
    fetch(url).then((response) =>{
            console.log(response);
            return response.json()
        }).then((data) => {
            console.log(data);
            // for (let item of json) {

            //     option = option + '<option value = "' + item['us->id'];
            //     option = option + '">' + item['$us->firstname'];
            //     option = option + item['$us->lastname'] + '</option>';
            // }

        }).catch((err) => {
            console.log('rejected',err);
        });


}

