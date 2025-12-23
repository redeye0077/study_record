document.addEventListener("DOMContentLoaded", function () {
    const el = document.getElementById("monthlyProgressBar");
    if (!el) return;

    const rate = Number(el.dataset.rate) || 0;

    const barColor = getComputedStyle(document.documentElement)
    .getPropertyValue("--progress-bar-color")
    .trim();

    const tickColor = getComputedStyle(document.documentElement)
    .getPropertyValue("--chart-tick-color")
    .trim();

    const gridColor = getComputedStyle(document.documentElement)
    .getPropertyValue("--chart-grid-color")
    .trim();

    new Chart(el, {
        type: "bar",
        data: {
            labels: ["進捗"],
            datasets: [
                {
                    label: "達成率（%）",
                    data: [rate],
                    borderWidth: 1,
                    backgroundColor: barColor,
                },
            ],
        },
        options: {
            indexAxis: "y",
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function (value) {
                            return value + "%";
                        },
                    color: tickColor, callback: (v) => v + "%",
                    },
                    grid: { color: gridColor },
                },
                y: {
                    ticks: { color: gridColor }, 
                    grid: { color: gridColor },
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function (ctx) {
                            return ctx.raw + "%";
                        },
                    },
                },
            },
        },
    });
});
