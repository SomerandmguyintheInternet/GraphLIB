/*This is the main Lib file and others are not needed*/
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Graphing Library</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js CDN for charting functionality -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Chart.js Data Labels Plugin for better readability -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <!-- Chart.js Box and Violin Plot Plugin for Box Plot -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-box-and-violin-plot@4.0.0"></script>
    <!-- Chart.js Financial Plugin for Candlestick Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-financial@0.1.0"></script>
    <style>
        /* Custom styles for better aesthetics and responsiveness */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8; /* Light background */
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align to top */
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            background-color: #ffffff;
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); /* Soft shadow */
            padding: 2rem;
            width: 100%;
            max-width: 1200px; /* Max width for larger screens */
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .chart-container {
            position: relative;
            height: 400px; /* Fixed height for consistency */
            width: 100%;
            margin: auto; /* Center the chart */
        }
        @media (min-width: 768px) {
            .container {
                flex-direction: row; /* Side-by-side on larger screens */
            }
            .controls {
                min-width: 250px; /* Fixed width for controls */
            }
            .chart-area {
                flex-grow: 1; /* Chart area takes remaining space */
            }
        }
        /* Tailwind-like styles for buttons, overriding some Bootstrap defaults for consistency */
        button {
            transition: all 0.2s ease-in-out;
            border-radius: 0.375rem; /* rounded-md */
            font-weight: 600; /* font-semibold */
            padding: 0.5rem 1rem; /* px-4 py-2 */
            border: 1px solid;
            --tw-border-opacity: 1;
            border-color: rgb(59 130 246 / var(--tw-border-opacity)); /* border-blue-500 */
            --tw-text-opacity: 1;
            color: rgb(29 78 216 / var(--tw-text-opacity)); /* text-blue-700 */
            background-color: #ffffff;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            --tw-bg-opacity: 1;
            background-color: rgb(239 246 255 / var(--tw-bg-opacity)); /* hover:bg-blue-50 */
        }
        button.active {
            background-color: #3b82f6; /* Blue-600 */
            color: white;
            border-color: #3b82f6;
        }
        /* Loading overlay styles */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
            border-radius: 12px;
        }
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #3b82f6;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Custom message box styles */
        .message-box-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .message-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .message-box button {
            margin-top: 15px;
            padding: 8px 15px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body class="antialiased">
    <div class="container">
        <!-- Controls Section -->
        <div class="controls p-4 bg-gray-50 rounded-lg shadow-inner flex flex-col gap-3">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Select Chart Type</h2>
            <div class="grid grid-cols-1 gap-2">
                <button id="lineChartBtn" class="focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Line Graph</button>
                <button id="barChartBtn" class="focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Bar Graph</button>
                <button id="histogramBtn" class="focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Histogram</button>
                <button id="pieChartBtn" class="focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Pie Chart</button>
                <button id="dotPlotBtn" class="focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Dot Plot</button>
                <button id="scatterPlotBtn" class="focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Scatter Plot</button>
                <button id="areaChartBtn" class="focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Area Chart</button>
                <button id="boxPlotBtn" class="focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Box Plot</button>
                <button id="candlestickChartBtn" class="focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Candlestick Chart</button>
                <button id="getAllDataBtn" class="btn btn-primary mt-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Get All Chart Data (API Demo)</button>
            </div>
            <p class="text-sm text-gray-600 mt-4">
                *Note: Waterfall, Gantt, and Violin charts are more specialized and often require dedicated libraries or significant custom implementation beyond the scope of this example. This demo focuses on commonly supported Chart.js types and those with readily available plugins.
            </p>
        </div>

        <!-- Chart Display Section -->
        <div class="chart-area p-4 bg-white rounded-lg shadow-md flex flex-col gap-4 relative">
            <h1 id="chartTitle" class="text-2xl font-bold text-gray-900 text-center">Select a Chart Type to Display</h1>
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
            <!-- Loading Overlay -->
            <div id="loadingOverlay" class="loading-overlay hidden">
                <div class="spinner"></div>
            </div>
        </div>
    </div>

    <!-- Custom Message Box Container -->
    <div id="messageBoxContainer" class="message-box-overlay hidden">
        <div class="message-box">
            <p id="messageBoxText" class="text-gray-800"></p>
            <button id="messageBoxCloseBtn">OK</button>
        </div>
    </div>

    <!-- Bootstrap JS CDN (optional, but good practice if using JS components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Register Chart.js plugins globally
        Chart.register(ChartDataLabels);
        // Box and Violin Plot plugin and Financial Chart plugin are automatically registered when their scripts are loaded

        // Global variable to hold the chart instance
        let myChart = null;
        const loadingOverlay = document.getElementById('loadingOverlay');
        const messageBoxContainer = document.getElementById('messageBoxContainer');
        const messageBoxText = document.getElementById('messageBoxText');
        const messageBoxCloseBtn = document.getElementById('messageBoxCloseBtn');

        // Define your PHP API endpoint URL
        // In a real scenario, this would be 'http://localhost/api-endpoint.php'
        const PHP_API_URL = 'http://localhost/api-endpoint.php'; // Replace with your actual PHP API URL

        /**
         * Displays a custom message box.
         * @param {string} message - The message to display.
         */
        function showMessageBox(message) {
            messageBoxText.innerText = message;
            messageBoxContainer.classList.remove('hidden');
        }

        // Close message box event listener
        messageBoxCloseBtn.addEventListener('click', () => {
            messageBoxContainer.classList.add('hidden');
        });

        /**
         * Fetches raw data from the PHP API endpoint.
         * @param {string} dataType - The type of data to request ('products' or 'financial').
         * @returns {Promise<Array<Object>>} A promise that resolves with the raw data.
         */
        async function fetchRawDataFromAPI(dataType) {
            loadingOverlay.classList.remove('hidden'); // Show loading spinner
            try {
                const response = await fetch(`${PHP_API_URL}?data_type=${dataType}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching raw data:', error);
                showMessageBox(`Failed to fetch data from API for ${dataType}. Please ensure your PHP API is running and configured correctly. Check console for details.`);
                return []; // Return empty array on error
            } finally {
                loadingOverlay.classList.add('hidden'); // Hide loading spinner
            }
        }

        /**
         * Processes raw data into Chart.js format based on the requested chart type.
         * This function now receives raw data and processes it locally.
         * @param {string} chartType - The type of chart data requested (e.g., 'line', 'bar', 'all').
         * @param {Array<Object>} rawData - The raw data fetched from the database.
         * @returns {Object|Array<Object>} The processed data for the requested chart type,
         * or an object containing processed data for all chart types if 'all' is requested.
         */
        function processChartData(chartType, rawData) {
            const processedData = {};

            // --- Data Processing Functions ---
            // These functions are pure and transform raw data into Chart.js compatible structures.

            // Line Graph Data
            const processLineData = (data) => {
                const salesByDate = data.reduce((acc, item) => {
                    if (item.transaction_date && typeof item.amount === 'number') {
                        acc[item.transaction_date] = (acc[item.transaction_date] || 0) + item.amount;
                    }
                    return acc;
                }, {});
                const sortedDates = Object.keys(salesByDate).sort();
                return {
                    labels: sortedDates,
                    datasets: [{
                        label: 'Total Sales',
                        data: sortedDates.map(date => salesByDate[date]),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                    }]
                };
            };

            // Bar Graph Data
            const processBarData = (data) => {
                const salesByCategory = data.reduce((acc, item) => {
                    if (item.product_category && typeof item.amount === 'number') {
                        acc[item.product_category] = (acc[item.product_category] || 0) + item.amount;
                    }
                    return acc;
                }, {});
                const barLabels = Object.keys(salesByCategory);
                const barData = Object.values(salesByCategory);
                const barColors = barLabels.map(() => getRandomColor(0.8));
                return {
                    labels: barLabels,
                    datasets: [{
                        label: 'Total Sales',
                        data: barData,
                        backgroundColor: barColors,
                        borderColor: barColors.map(color => color.replace('0.8', '1')),
                        borderWidth: 1
                    }]
                };
            };

            // Histogram Data
            const processHistogramData = (data) => {
                const prices = data.filter(item => typeof item.product_price === 'number').map(item => item.product_price);
                if (prices.length === 0) {
                    return null; // Indicate no data
                }
                const minPrice = Math.min(...prices);
                const maxPrice = Math.max(...prices);
                const binCount = 10;
                const binWidth = (maxPrice - minPrice) / binCount;

                const bins = Array(binCount).fill(0);
                const histogramLabels = [];

                for (let i = 0; i < binCount; i++) {
                    const lowerBound = minPrice + i * binWidth;
                    const upperBound = minPrice + (i + 1) * binWidth;
                    histogramLabels.push(`${lowerBound.toFixed(0)}-${upperBound.toFixed(0)}`);
                    prices.forEach(price => {
                        if (price >= lowerBound && (price < upperBound || (i === binCount - 1 && price <= upperBound))) {
                            bins[i]++;
                        }
                    });
                }
                const histogramColors = histogramLabels.map(() => getRandomColor(0.8));
                return {
                    labels: histogramLabels,
                    datasets: [{
                        label: 'Number of Products',
                        data: bins,
                        backgroundColor: histogramColors,
                        borderColor: histogramColors.map(color => color.replace('0.8', '1')),
                        borderWidth: 1
                    }]
                };
            };

            // Pie Chart Data
            const processPieData = (data) => {
                const pieSalesByCategory = data.reduce((acc, item) => {
                    if (item.product_category && typeof item.amount === 'number') {
                        acc[item.product_category] = (acc[item.product_category] || 0) + item.amount;
                    }
                    return acc;
                }, {});
                const pieLabels = Object.keys(pieSalesByCategory);
                const pieData = Object.values(pieSalesByCategory);
                const pieColors = pieLabels.map(() => getRandomColor(0.8));
                return {
                    labels: pieLabels,
                    datasets: [{
                        label: 'Sales %',
                        data: pieData,
                        backgroundColor: pieColors,
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                };
            };

            // Dot Plot Data
            const processDotData = (data) => {
                const dotData = data.filter(item => typeof item.quantity === 'number').map((item, index) => ({
                    x: item.quantity,
                    y: 1,
                    label: `Transaction ${item.id}: ${item.quantity} units`
                }));
                return {
                    datasets: [{
                        label: 'Units Sold',
                        data: dotData,
                        backgroundColor: 'rgba(153, 102, 255, 0.8)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                    }]
                };
            };

            // Scatter Plot Data
            const processScatterData = (data) => {
                const scatterData = data.filter(item => typeof item.product_price === 'number' && typeof item.customer_rating === 'number')
                                        .map(item => ({ x: item.product_price, y: item.customer_rating }));
                return {
                    datasets: [{
                        label: 'Product Price vs. Rating',
                        data: scatterData,
                        backgroundColor: 'rgba(255, 99, 132, 0.8)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                    }]
                };
            };

            // Area Chart Data
            const processAreaData = (data) => {
                const cumulativeSalesByDate = data.reduce((acc, item) => {
                    if (item.transaction_date && typeof item.amount === 'number') {
                        acc[item.transaction_date] = (acc[item.transaction_date] || 0) + item.amount;
                    }
                    return acc;
                }, {});

                const sortedAreaDates = Object.keys(cumulativeSalesByDate).sort();
                const areaLabels = sortedAreaDates;
                let cumulativeSum = 0;
                const areaData = sortedAreaDates.map(date => {
                    cumulativeSum += cumulativeSalesByDate[date];
                    return cumulativeSum;
                });
                return {
                    labels: areaLabels,
                    datasets: [{
                        label: 'Cumulative Sales',
                        data: areaData,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                    }]
                };
            };

            // Box Plot Data
            const processBoxData = (data) => {
                const ratingsByCategory = data.reduce((acc, item) => {
                    if (item.product_category && typeof item.customer_rating === 'number') {
                        if (!acc[item.product_category]) {
                            acc[item.product_category] = [];
                        }
                        acc[item.product_category].push(item.customer_rating);
                    }
                    return acc;
                }, {});

                const boxLabels = Object.keys(ratingsByCategory);
                const boxData = Object.values(ratingsByCategory);
                const boxColors = boxLabels.map(() => getRandomColor(0.8));
                return {
                    labels: boxLabels,
                    datasets: [{
                        label: 'Ratings',
                        data: boxData,
                        backgroundColor: boxColors,
                        borderColor: boxColors.map(color => color.replace('0.8', '1')),
                        borderWidth: 1,
                        itemStyle: 'circle',
                        itemRadius: 4,
                        itemBackgroundColor: 'rgba(0,0,0,0.2)',
                        itemBorderColor: 'rgba(0,0,0,0.5)',
                    }]
                };
            };

            // Candlestick Data (expects OHLC format in rawData)
            const processCandlestickData = (data) => {
                const candlestickLabels = data.map(item => item.date);
                const candlestickData = data.map(item => ({
                    x: item.date,
                    o: item.open,
                    h: item.high,
                    l: item.low,
                    c: item.close,
                }));
                return {
                    labels: candlestickLabels,
                    datasets: [{
                        label: 'Price',
                        data: candlestickData,
                        financial: {
                            color: {
                                up: 'rgba(75, 192, 192, 1)',
                                down: 'rgba(255, 99, 132, 1)'
                            }
                        }
                    }]
                };
            };

            // --- Process based on requestedChartType ---
            if (chartType === 'all') {
                // For 'all' request, we need to fetch both product and financial data
                // This part of the logic will be handled by the calling function (getAllDataBtn click)
                // as it needs to make two separate API calls.
                // This function assumes rawData is for 'products' unless explicitly for 'candlestick'.
                processedData.line = processLineData(rawData);
                processedData.bar = processBarData(rawData);
                processedData.histogram = processHistogramData(rawData);
                processedData.pie = processPieData(rawData);
                processedData.dot = processDotData(rawData);
                processedData.scatter = processScatterData(rawData);
                processedData.area = processAreaData(rawData);
                processedData.box = processBoxData(rawData);
                // Candlestick data is handled separately when 'all' is requested,
                // as it comes from a different data source.
                return processedData;
            } else {
                let result = null;
                switch (chartType) {
                    case 'line': result = processLineData(rawData); break;
                    case 'bar': result = processBarData(rawData); break;
                    case 'histogram': result = processHistogramData(rawData); break;
                    case 'pie': result = processPieData(rawData); break;
                    case 'dot': result = processDotData(rawData); break;
                    case 'scatter': result = processScatterData(rawData); break;
                    case 'area': result = processAreaData(rawData); break;
                    case 'box': result = processBoxData(rawData); break;
                    case 'candlestick': result = processCandlestickData(rawData); break; // rawData here is already financial data
                }
                return result;
            }
        }


        /**
         * Renders a chart based on the specified type and already processed data.
         * @param {string} chartType - The type of chart to render (e.g., 'line', 'bar', 'pie').
         * @param {Object} processedChartData - The data already processed into Chart.js format.
         */
        function renderChart(chartType, processedChartData) {
            destroyChart(); // Always destroy the previous chart before rendering a new one

            if (!processedChartData) {
                showMessageBox(`No data available for ${chartType} chart or processing failed.`);
                document.getElementById('chartTitle').innerText = 'Select a Chart Type to Display';
                return;
            }

            const ctx = document.getElementById('myChart').getContext('2d');
            let chartConfig = {};
            let chartTitle = '';

            // Common chart options for responsive design and styling
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false, // Allow chart to fill container height
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                                family: 'Inter'
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                if (chartType === 'candlestick') {
                                    // For financial chart, the x-axis value is the date
                                    return context[0].element.$context.parsed.x;
                                }
                                return context[0].label || '';
                            },
                            label: function(context) {
                                if (chartType === 'candlestick') {
                                    const { o, h, l, c } = context.raw;
                                    return [
                                        `Open: ${o}`,
                                        `High: ${h}`,
                                        `Low: ${l}`,
                                        `Close: ${c}`
                                    ];
                                }
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('en-US').format(context.parsed.y);
                                } else if (context.parsed.x !== null) {
                                    label += new Intl.NumberFormat('en-US').format(context.parsed.x);
                                }
                                return label;
                            }
                        },
                        titleFont: { size: 14, family: 'Inter' },
                        bodyFont: { size: 12, family: 'Inter' },
                        padding: 10,
                        boxPadding: 5,
                        cornerRadius: 6,
                    },
                    datalabels: { // Plugin for displaying data labels on the chart
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 10
                        },
                        formatter: (value, context) => {
                            if (chartType === 'pie') {
                                // For pie chart, show percentage
                                const sum = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = (value / sum * 100).toFixed(1) + '%';
                                return percentage;
                            }
                            // For box plot and candlestick, don't show individual point labels by default
                            if (chartType === 'box' || chartType === 'candlestick') return '';
                            // For histogram, only show label if count > 0
                            if (chartType === 'histogram' && value === 0) return '';
                            return value; // For other charts, show the value directly
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: { size: 12, family: 'Inter' }
                        },
                        grid: {
                            display: false // Hide x-axis grid lines
                        }
                    },
                    y: {
                        ticks: {
                            font: { size: 12, family: 'Inter' }
                        },
                        grid: {
                            color: '#e2e8f0' // Light gray grid lines
                        }
                    }
                }
            };

            // Chart-specific configurations (now using processedChartData directly)
            switch (chartType) {
                case 'line':
                    chartTitle = 'Sales Trend Over Time (Line Graph)';
                    chartConfig = {
                        type: 'line',
                        data: processedChartData,
                        options: {
                            ...commonOptions,
                            scales: {
                                x: {
                                    ...commonOptions.scales.x,
                                    title: {
                                        display: true,
                                        text: 'Date',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                },
                                y: {
                                    ...commonOptions.scales.y,
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Sales Amount',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                }
                            }
                        }
                    };
                    break;

                case 'bar':
                    chartTitle = 'Sales by Category (Bar Graph)';
                    chartConfig = {
                        type: 'bar',
                        data: processedChartData,
                        options: {
                            ...commonOptions,
                            scales: {
                                x: {
                                    ...commonOptions.scales.x,
                                    title: {
                                        display: true,
                                        text: 'Product Category',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                },
                                y: {
                                    ...commonOptions.scales.y,
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Sales Amount',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                }
                            }
                        }
                    };
                    break;

                case 'histogram':
                    chartTitle = 'Distribution of Product Prices (Histogram Simulation)';
                    chartConfig = {
                        type: 'bar', // Histogram is simulated using a bar chart
                        data: processedChartData,
                        options: {
                            ...commonOptions,
                            scales: {
                                x: {
                                    ...commonOptions.scales.x,
                                    title: {
                                        display: true,
                                        text: 'Price Range',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                },
                                y: {
                                    ...commonOptions.scales.y,
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Frequency',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    },
                                    ticks: {
                                        stepSize: 1 // Ensure integer ticks for frequency
                                    }
                                }
                            }
                        }
                    };
                    break;

                case 'pie':
                    chartTitle = 'Sales Proportion by Category (Pie Chart)';
                    chartConfig = {
                        type: 'pie',
                        data: processedChartData,
                        options: {
                            ...commonOptions,
                            scales: {
                                x: { display: false }, // Hide x-axis for pie chart
                                y: { display: false }  // Hide y-axis for pie chart
                            },
                            plugins: {
                                ...commonOptions.plugins,
                                legend: {
                                    position: 'right', // Place legend on the right for pie chart
                                    labels: {
                                        font: { size: 12, family: 'Inter' }
                                    }
                                },
                                datalabels: {
                                    ...commonOptions.plugins.datalabels,
                                    color: '#fff', // White color for labels on dark slices
                                    textShadowBlur: 4,
                                    textShadowColor: 'rgba(0,0,0,0.5)',
                                    formatter: (value, context) => {
                                        const sum = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = (value / sum * 100).toFixed(1);
                                        return `${context.chart.data.labels[context.dataIndex]}\n${percentage}%`;
                                    }
                                }
                            }
                        }
                    };
                    break;

                case 'dot':
                    chartTitle = 'Units Sold Per Transaction (Dot Plot Simulation)';
                    chartConfig = {
                        type: 'scatter',
                        data: processedChartData,
                        options: {
                            ...commonOptions,
                            scales: {
                                x: {
                                    ...commonOptions.scales.x,
                                    type: 'linear', // Ensure linear scale for numerical data
                                    position: 'bottom',
                                    title: {
                                        display: true,
                                        text: 'Units Sold',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    },
                                    ticks: {
                                        stepSize: 1 // Ensure integer ticks for units
                                    }
                                },
                                y: {
                                    ...commonOptions.scales.y,
                                    display: false, // Hide Y-axis as it's just a placeholder
                                    max: 2, // Keep points centered on y=1
                                    min: 0,
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            plugins: {
                                ...commonOptions.plugins,
                                datalabels: {
                                    display: false // Hide data labels for cleaner dot plot
                                }
                            }
                        }
                    };
                    break;

                case 'scatter':
                    chartTitle = 'Price vs. Rating (Scatter Plot)';
                    chartConfig = {
                        type: 'scatter',
                        data: processedChartData,
                        options: {
                            ...commonOptions,
                            scales: {
                                x: {
                                    ...commonOptions.scales.x,
                                    type: 'linear',
                                    position: 'bottom',
                                    title: {
                                        display: true,
                                        text: 'Product Price',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                },
                                y: {
                                    ...commonOptions.scales.y,
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Customer Rating',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                }
                            },
                            plugins: {
                                ...commonOptions.plugins,
                                datalabels: {
                                    display: false // Hide data labels for cleaner scatter plot
                                }
                            }
                        }
                    };
                    break;

                case 'area':
                    chartTitle = 'Cumulative Sales Over Time (Area Chart)';
                    chartConfig = {
                        type: 'line', // Area chart is a line chart with fill: true
                        data: processedChartData,
                        options: {
                            ...commonOptions,
                            scales: {
                                x: {
                                    ...commonOptions.scales.x,
                                    title: {
                                        display: true,
                                        text: 'Date',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                },
                                y: {
                                    ...commonOptions.scales.y,
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Cumulative Sales Amount',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                }
                            }
                        }
                    };
                    break;

                case 'box':
                    chartTitle = 'Product Ratings Distribution by Category (Box Plot)';
                    chartConfig = {
                        type: 'boxPlot', // Type for box plot from the plugin
                        data: processedChartData,
                        options: {
                            ...commonOptions,
                            scales: {
                                x: {
                                    ...commonOptions.scales.x,
                                    title: {
                                        display: true,
                                        text: 'Product Category',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                },
                                y: {
                                    ...commonOptions.scales.y,
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Rating',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    },
                                    min: 0,
                                    max: 5, // Assuming ratings are 0-5
                                    ticks: {
                                        stepSize: 0.5
                                    }
                                }
                            },
                            plugins: {
                                ...commonOptions.plugins,
                                datalabels: {
                                    display: false // Typically don't show datalabels on box plots
                                }
                            }
                        }
                    };
                    break;

                case 'candlestick':
                    chartTitle = 'Financial Data (Candlestick Chart)';
                    chartConfig = {
                        type: 'candlestick', // Type for candlestick chart from the plugin
                        data: processedChartData,
                        options: {
                            ...commonOptions,
                            scales: {
                                x: {
                                    ...commonOptions.scales.x,
                                    type: 'time', // Use time scale for dates
                                    time: {
                                        unit: 'day',
                                        tooltipFormat: 'MMM DD, YYYY',
                                        displayFormats: {
                                            day: 'MMM DD'
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Date',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                },
                                y: {
                                    ...commonOptions.scales.y,
                                    title: {
                                        display: true,
                                        text: 'Price',
                                        font: { size: 14, weight: 'bold', family: 'Inter' }
                                    }
                                }
                            },
                            plugins: {
                                ...commonOptions.plugins,
                                datalabels: {
                                    display: false // Typically don't show datalabels on candlestick charts
                                }
                            }
                        }
                    };
                    break;

                default:
                    // If no chart type is selected or recognized
                    document.getElementById('chartTitle').innerText = 'Select a Chart Type to Display';
                    return;
            }

            // Update the chart title
            document.getElementById('chartTitle').innerText = chartTitle;

            // Create the new chart instance
            myChart = new Chart(ctx, chartConfig);
        }

        // --- Event Listeners for Buttons ---
        document.getElementById('lineChartBtn').addEventListener('click', async () => {
            const rawData = await fetchRawDataFromAPI('products');
            const data = processChartData('line', rawData);
            renderChart('line', data);
            setActiveButton('lineChartBtn');
            history.pushState(null, '', '?graph=line'); // Update URL
        });
        document.getElementById('barChartBtn').addEventListener('click', async () => {
            const rawData = await fetchRawDataFromAPI('products');
            const data = processChartData('bar', rawData);
            renderChart('bar', data);
            setActiveButton('barChartBtn');
            history.pushState(null, '', '?graph=bar'); // Update URL
        });
        document.getElementById('histogramBtn').addEventListener('click', async () => {
            const rawData = await fetchRawDataFromAPI('products');
            const data = processChartData('histogram', rawData);
            renderChart('histogram', data);
            setActiveButton('histogramBtn');
            history.pushState(null, '', '?graph=histogram'); // Update URL
        });
        document.getElementById('pieChartBtn').addEventListener('click', async () => {
            const rawData = await fetchRawDataFromAPI('products');
            const data = processChartData('pie', rawData);
            renderChart('pie', data);
            setActiveButton('pieChartBtn');
            history.pushState(null, '', '?graph=pie'); // Update URL
        });
        document.getElementById('dotPlotBtn').addEventListener('click', async () => {
            const rawData = await fetchRawDataFromAPI('products');
            const data = processChartData('dot', rawData);
            renderChart('dot', data);
            setActiveButton('dotPlotBtn');
            history.pushState(null, '', '?graph=dot'); // Update URL
        });
        document.getElementById('scatterPlotBtn').addEventListener('click', async () => {
            const rawData = await fetchRawDataFromAPI('products');
            const data = processChartData('scatter', rawData);
            renderChart('scatter', data);
            setActiveButton('scatterPlotBtn');
            history.pushState(null, '', '?graph=scatter'); // Update URL
        });
        document.getElementById('areaChartBtn').addEventListener('click', async () => {
            const rawData = await fetchRawDataFromAPI('products');
            const data = processChartData('area', rawData);
            renderChart('area', data);
            setActiveButton('areaChartBtn');
            history.pushState(null, '', '?graph=area'); // Update URL
        });
        document.getElementById('boxPlotBtn').addEventListener('click', async () => {
            const rawData = await fetchRawDataFromAPI('products');
            const data = processChartData('box', rawData);
            renderChart('box', data);
            setActiveButton('boxPlotBtn');
            history.pushState(null, '', '?graph=box'); // Update URL
        });
        document.getElementById('candlestickChartBtn').addEventListener('click', async () => {
            const rawData = await fetchRawDataFromAPI('financial'); // Fetch financial data
            const data = processChartData('candlestick', rawData);
            renderChart('candlestick', data);
            setActiveButton('candlestickChartBtn');
            history.pushState(null, '', '?graph=candlestick'); // Update URL
        });

        document.getElementById('getAllDataBtn').addEventListener('click', async () => {
            const rawProductData = await fetchRawDataFromAPI('products');
            const rawFinancialData = await fetchRawDataFromAPI('financial');

            // Simulate requesting all data types from the API
            const allProcessedData = {
                products: processChartData('all', rawProductData),
                financial: processChartData('candlestick', rawFinancialData) // Candlestick data is distinct
            };

            console.log("All Processed Chart Data (as if returned to PHP):", allProcessedData);
            showMessageBox("All chart data (for products and financial) has been processed and logged to the console. A PHP page could now use this comprehensive object to dynamically present chart options or render multiple charts.");
            destroyChart(); // Clear current chart
            document.getElementById('chartTitle').innerText = 'All Data Processed (Check Console)';
            setActiveButton('getAllDataBtn');
            history.pushState(null, '', window.location.pathname); // Clear graph parameter from URL
        });

        /**
         * Sets the active state for the clicked button and removes it from others.
         * @param {string} activeBtnId - The ID of the button to set as active.
         */
        function setActiveButton(activeBtnId) {
            const buttons = document.querySelectorAll('.controls button');
            buttons.forEach(button => {
                if (button.id === activeBtnId) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
        }

        // --- Initial Chart Load based on URL Parameter ---
        document.addEventListener('DOMContentLoaded', async () => {
            const urlParams = new URLSearchParams(window.location.search);
            const graphId = urlParams.get('graph');

            if (graphId) {
                let rawData;
                if (graphId === 'candlestick') {
                    rawData = await fetchRawDataFromAPI('financial');
                } else {
                    rawData = await fetchRawDataFromAPI('products');
                }

                const processedData = processChartData(graphId, rawData);
                if (processedData) {
                    renderChart(graphId, processedData);
                    // Find the corresponding button and set it active
                    const buttonId = `${graphId}ChartBtn`;
                    const button = document.getElementById(buttonId);
                    if (button) {
                        setActiveButton(buttonId);
                    }
                } else {
                    showMessageBox(`Could not load graph '${graphId}'. Invalid graph ID or no data.`);
                }
            }
        });
    </script>
</body>
</html>
