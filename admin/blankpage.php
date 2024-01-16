<?php

require_once '../includes/components/header.php';
?>

<body class="bg-gray-50 dark:bg-gray-800">

    <?php require_once "../includes/components/nav.php";?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>

        <div id="main-content" class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

            <main>
                <div class="px-4 pt-6 pr-4">
                    

                  Blank page

                  put your div here

                </div>
                <!-- Included Footer.php -->
                <?php 
                    require_once "../includes/components/footer.php";
                    ?>
            </main>
        </div>
    </div>

    </div>

    <?php
    $sql = "SELECT CivilStatus, COUNT(*) AS count FROM Survey GROUP BY CivilStatus";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $statusCounts = array(
            "Single" => 0,
            "Married" => 0,
            "Divorced" => 0,
            "Widowed" => 0
        );

        while ($row = $result->fetch_assoc()) {
            $statusCounts[$row["CivilStatus"]] = $row["count"];
        }

        $total = array_sum($statusCounts);
        $statusPercentages = array_map(function ($count) use ($total) {
            return round(($count / $total) * 100, 2);
        }, $statusCounts);

        $statusPercentagesJson = json_encode(array_values($statusPercentages));

        echo '<script>
        window.addEventListener("load", function () {
            const seriesData = ' . $statusPercentagesJson . ';
            const getChartOptions = () => {
                return {
                    series: seriesData,
                    colors: ["#52D3D8", "#3887BE", "#38419D", "#200E3A"],
                    chart: {
                        height: 420,
                        width: "100%",
                        type: "pie",
                    },
                    stroke: {
                        colors: ["white"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            labels: {
                                show: true,
                            },
                            size: "100%",
                            dataLabels: {
                                offset: -25
                            }
                        },
                    },
                    labels: ["Single", "Married", "Divorced", "Widowed"],
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value + "%"
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function (value) {
                                return value + "%"
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                };
            }
            if (document.getElementById("pie-chart") && typeof ApexCharts !== "undefined") {
                const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
                chart.render();
            }
        });
    </script>';
    } else {
        echo "0 results";
    }
    ?>
</body>

</html>