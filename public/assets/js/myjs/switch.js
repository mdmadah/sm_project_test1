$(document).ready(function() {
                
    $('.switch').change(function() {
    // this will contain a reference to the checkbox


        let id = this.id;
        let status = 0;

        if (this.checked) {
            console.log(this.id);
            status = 1;
            // the checkbox is now checked 
        } else {
            console.log(this.id);
            // the checkbox is now no longer checked
        }
        // console.log("{{ url('/api/updateNameTitle') }}");

        $.ajax({
            url: "{{ url('/api/updateStatusNameTitle') }}",

            type: 'POST',
            dataType: 'JSON',
            data: {id,status},
            success:function(data){
                console.log(data);


            }
        });
    });
});