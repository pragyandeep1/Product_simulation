<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Simulation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body style="background-color: black; color:white">
    <div class="contrainer d-flex">
        <div class="col-md-6">
            <h3>Product 1</h3>
            <p>Bbsr - 100 <br>
               751019 - 10 <br>
               751015 - 15 <br>
               751021 - 20 <br>
               752031 - 30 <br><br>
               CTC - 120 <br>
               754019 - 12 <br>
               753015 - 17 <br>
               753021 - 19 <br>
               754031 - 23 <br>
            </p>
        </div>
        <div class="col-md-6">
            <h3>Product 2</h3>
            <p>Bbsr - 150 <br>
               751019 - 10 <br>
               751015 - 15 <br>
               751021 - 20 <br>
               752031 - 30 <br><br>
               CTC - 170 <br>
               754019 - 12 <br>
               753015 - 17 <br>
               753021 - 19 <br>
               754031 - 23 <br>
            </p>
        </div>
    </div>
    <div class="container mt-5">
        <div class="col-md-8">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <select class="form-select" name="product" id="product">
                        <option value="product_1" <?php if (isset($_GET['product']) && $_GET['product'] === 'product_1') echo 'selected'; ?>>Product 1</option>
                        <option value="product_2" <?php if (isset($_GET['product']) && $_GET['product'] === 'product_2') echo 'selected'; ?>>Product 2</option>
                    </select>
                    <select class="form-select" name="city" id="city">
                        <option value="bbsr" <?php if (isset($_GET['city']) && $_GET['city'] === 'bbsr') echo 'selected'; ?>>Bbsr</option>
                        <option value="ctc" <?php if (isset($_GET['city']) && $_GET['city'] === 'ctc') echo 'selected'; ?>>CTC</option>
                    </select>
                    <input type="text" class="form-control" name="search" placeholder="Enter Pin Code" value="<?php if(isset($_GET['search'])) echo $_GET['search']?>">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    Bhubaneswar/Cuttack
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($_GET['product']) && isset($_GET['city']) && !empty($_GET['city'])) {
                            $product = strtolower(trim($_GET['product']));
                            $city = strtolower(trim($_GET['city']));
                            $search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

                            // Sample data for demonstration
                            $data = [
                                'product_1' => [
                                    'base_price' => ['bbsr' => 100, 'ctc' => 120],
                                    'locations' => [
                                        '751019' => 10,
                                        '751015' => 15,
                                        '751021' => 20,
                                        '752031' => 30,
                                        '754019' => 12,
                                        '753015' => 17,
                                        '753021' => 19,
                                        '754031' => 23,
                                    ],
                                ],
                                'product_2' => [
                                    'base_price' => ['bbsr' => 150, 'ctc' => 170],
                                    'locations' => [
                                        '751019' => 10,
                                        '751015' => 15,
                                        '751021' => 20,
                                        '752031' => 30,
                                        '754019' => 12,
                                        '753015' => 17,
                                        '753021' => 19,
                                        '754031' => 23,
                                    ],
                                ],
                            ];

                            // Display base price if no pin code is entered
                            if (empty($search)) {
                                $base_price = $data[$product]['base_price'][$city];
                                echo "<tr>
                                        <td>" . htmlspecialchars(ucwords(str_replace('_', ' ', $product))) . "</td>
                                        <td>" . htmlspecialchars($base_price) . "</td>
                                        <td>" . htmlspecialchars(strtoupper($city)) . "</td>
                                    </tr>";
                            } else {
                                // Matching results for pin code
                                $found = false;
                                if (array_key_exists($search, $data[$product]['locations'])) {
                                    $found = true;

                                    // Use the selected city's base price
                                    $base_price = $data[$product]['base_price'][$city];
                                    $resultant_price = $base_price + $data[$product]['locations'][$search];

                                    echo "<tr>
                                            <td>" . htmlspecialchars(ucwords(str_replace('_', ' ', $product))) . "</td>
                                            <td>" . htmlspecialchars($resultant_price) . "</td>
                                            <td>" . htmlspecialchars(strtoupper($search)) . "</td>
                                        </tr>";
                                }

                                if (!$found) {
                                    echo "<tr>
                                            <td colspan='3'>Product is not available in your location.</td>
                                        </tr>";
                                }
                            }
                        }
                        ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setSearchType(type) {
            document.getElementById('search_type').value = type;
        }
    </script>
</body>
</html>