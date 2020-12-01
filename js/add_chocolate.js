getBahan();

async function getBahan(){
    var table = document.querySelector('table');
    const mantap = await fetch('http://localhost:4000/supplier-api/tampil', {
            method: 'get',
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
            }
        }).then(res => res.json())
        .then( data => {
            //const data = res;
            //let hasil = '';
            data.forEach( (x) => {
                table.innerHTML += 
                    `<tr>
                        <td>${x.nama_bahan}</td>
                        <td>${x.nama_supplier}</td>
                        <td>${x.harga_per_satuan}/${x.satuan}</td>
                    </tr>`
                ;
            })
            //const bahanContainer = document.querySelector('.bahan_container');
            //bahanContainer.innerHTML = hasil;
        })
        //.then(w => console.log(res));
    // console.log(mantap);
    // for(i = 0; i < mantap.length; i++){
    //     document.write('<p>' + mantap[i].nama_bahan + '</p>')
    // }

        
        //        .then(res => console.log(res[0]))
        
}