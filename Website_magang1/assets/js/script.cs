<script>
const labelHarian   = <?= json_encode($label_harian); ?>;
const dataHarian    = <?= json_encode($data_harian); ?>;
const labelInstansi = <?= json_encode($label_instansi); ?>;
const dataInstansi  = <?= json_encode($data_instansi); ?>;
const labelBulan    = <?= json_encode($label_bulan); ?>;
const dataBulan     = <?= json_encode($data_bulan); ?>;

new Chart(barChart,{
    type:'bar',
    data:{
        labels:labelHarian,
        datasets:[{
            label:'Kunjungan Harian',
            data:dataHarian
        }]
    }
});

new Chart(pieChart,{
    type:'pie',
    data:{
        labels:labelInstansi,
        datasets:[{
            data:dataInstansi
        }]
    }
});

new Chart(lineChart,{
    type:'line',
    data:{
        labels:labelHarian,
        datasets:[{
            label:'Tren Kunjungan',
            data:dataHarian,
            tension:0.4,
            fill:false
        }]
    }
});

new Chart(columnChart,{
    type:'bar',
    data:{
        labels:labelBulan,
        datasets:[{
            label:'Kunjungan Bulanan',
            data:dataBulan
        }]
    }
});
</script>
