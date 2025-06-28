document.addEventListener('DOMContentLoaded', function () {
    const dates = chartDates;
    const subjects = chartSubjects;
    const data = chartData;

    const truncatedDates = dates.slice(Math.max(dates.length - 7, 0));

    const datasets = subjects.map((subject) => {
        const subjectData = truncatedDates.map(date => {
            const record = data[date].find(record => record.subject === subject);
            return record ? record.duration : 0;
        });

        const colors = [
            'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)',
        ];
        const borderColors = [
            'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)',
        ];

        const colorIndex = subjects.indexOf(subject) % colors.length;

        return {
            label: subject,
            data: subjectData,
            backgroundColor: colors[colorIndex],
            borderColor: borderColors[colorIndex],
            borderWidth: 1,
        };
    });

    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: truncatedDates,
            datasets: datasets,
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    stacked: true,
                    ticks: {
                        callback: function (value) {
                            return value + '分';
                        }
                    },
                    title: {
                        display: true,
                        text: '学習時間'
                    }
                },
                x: {
                    stacked: true,
                    title: {
                        display: true,
                        text: '日付'
                    }
                }
            }
        }
    });
});
