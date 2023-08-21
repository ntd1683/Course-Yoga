import {Chart} from "chart.js/auto";

// Lấy thẻ canvas và khai báo dữ liệu
const canvas = document.getElementById('chartRevenue');
let ctx = canvas.getContext('2d');
canvas.width = 200;
canvas.height = 200;
let data = {
    labels: [],
    datasets: [{
        label: 'Biểu Đồ Thống Kê Doanh Thu',
        data: [],
        borderWidth: 1
    }]
};

// Tạo biểu đồ dạng cột
const myChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

function getRevenue(filter = 0) {
    $.ajax({
        method: 'GET',
        url: $('#form_get_revenue').data('ajax'),
        data: {
            "filter": filter,
        },
        success: function (data) {
            myChart.data.labels = data['labels'];
            myChart.data.datasets[0].data = data['data'];
            myChart.update();
        },
    });
}

getRevenue();

$('#select-time').change((e) => {
    console.log(e.target.value);
    getRevenue(e.target.value);
})
