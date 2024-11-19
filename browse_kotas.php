<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Kotas</title>    

    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            background-image: url('images/background.jpg'); /* Set your background image */
            background-size: cover;
            font-family: Arial, sans-serif; /* Default font */
            color: #333; /* Text color */
            display: flex;
            flex-direction: column;
            align-items: center; /* Center content horizontally */
            padding: 20px; /* Add padding around the content */
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px; /* Space below the title */
        }

        /* Filter Styles */
        .filter {
            background-color: rgba(255, 255, 255, 0.9); /* Slightly more opaque white */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
            width: 100%;
            max-width: 600px; /* Limit width */
        }

        .filter label {
            display: block; /* Stack labels and selects */
            margin-bottom: 5px;
        }

        .filter select {
            width: calc(100% - 16px); /* Full width for select boxes */
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box; /* Include padding in width */
        }

        #filter_button {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Full width for the button */
            font-size: 16px; /* Font size */
        }

        #filter_button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        /* Kota Item Styles */
        .kota-item {
            background-color: rgba(255, 255, 255, 0.9); /* Slightly more opaque white */
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px; /* More space between items */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px; /* Limit kota-item width */
            text-align: center; /* Center text */
        }

        .kota-item img {
            width: 100%; /* Full width */
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px; /* Space below the image */
        }

        .order-button {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center; /* Center text */
            display: inline-block; /* Inline block for button */
            width: 100%; /* Full width for the button */
            text-decoration: none; /* Remove underline */
            font-size: 16px; /* Font size */
        }

        .order-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .order-button.disabled {
            background-color: #ccc; /* Gray background for disabled button */
            cursor: not-allowed;
        }

        /* Ingredient Exclusion section */
        .ingredient-exclusion {
            margin-top: 10px;
            text-align: left;
        }

        .ingredient-exclusion label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .ingredient-exclusion select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .price-change {
            font-size: 16px;
            color: #e74c3c; /* Red color for change */
            margin-top: 10px;
        }

        .updated-price {
            font-size: 18px;
            font-weight: bold;
            color: #4CAF50; /* Green for updated price */
        }
    </style>
</head>
<body>

    <h1>Browse Kotas</h1>

    <!-- Filter Section -->
    <div class="filter">
        <h2>Filters</h2>
        
        <!-- Category Filter -->
        <label for="Categories_sp">Categories:</label>
        <select id="Categories_sp">
            <option value="category1">Cheapest to Highest</option>
            <option value="category2">Highest to Cheapest</option>
        </select>

        <!-- Location Filter -->
        <label for="Location_sp">Location:</label>
        <select id="Location_sp">
            <option value="location1">Braamfontein</option>
            <option value="location2">NewTown</option>
            <option value="location3">ParkTown Kota XZ</option>
            <option value="location4">JHB CBD</option>
        </select>

        <!-- Filter Button -->
        <button id="filter_button">Filter</button>
    </div>

    <!-- Kota Item: R50 -->
    <div class="kota-item" id="item_1" data-price="50">
        <img src="images/koat1.jpeg" alt="Kota 1">
        <h4>Name: Royal Feast</h4>
        <p>Price: R50.00</p>
        <a class="order-button" href="cart.php?item=Royal Feast&price=50">Order Now</a>

        <!-- Ingredient Exclusion -->
        <div class="ingredient-exclusion">
            <label for="exclude_ingredients_1">Select Ingredients to Remove/Add:</label>
            <select id="exclude_ingredients_1">
                <option value="none">-- Select an Ingredient --</option>
                <option value="cheese_remove">Cheese (Remove -R5)</option>
                <option value="mayo_remove">Mayo (Remove -R5)</option>
                <option value="tomato_remove">Tomato (Remove -R3)</option>
                <option value="egg_remove">Egg (Remove -R4)</option>
                <option value="chili_remove">Chili (Remove -R2)</option>
                <option value="cheese_add">Cheese (Add +R5)</option>
                <option value="mayo_add">Mayo (Add +R5)</option>
                <option value="tomato_add">Tomato (Add +R3)</option>
                <option value="egg_add">Egg (Add +R4)</option>
                <option value="chili_add">Chili (Add +R2)</option>
            </select>
            <p class="price-change" id="price_change_1">Price Change: R0.00</p>
            <p class="updated-price" id="updated_price_1">Updated Price: R50.00</p>
        </div>
    </div>

    <!-- Kota Item: R60 -->
    <div class="kota-item" id="item_2" data-price="60">
        <img src="images/kota2.jpeg" alt="Kota 2">
        <h4>Name: Golden Delight</h4>
        <p>Price: R60.00</p>
        <a class="order-button" href="cart.php?item=Golden Delight&price=60">Order Now</a>

        <!-- Ingredient Exclusion -->
        <div class="ingredient-exclusion">
            <label for="exclude_ingredients_2">Select Ingredients to Remove/Add:</label>
            <select id="exclude_ingredients_2">
                <option value="none">-- Select an Ingredient --</option>
                <option value="cheese_remove">Cheese (Remove -R5)</option>
                <option value="mayo_remove">Mayo (Remove -R5)</option>
                <option value="tomato_remove">Tomato (Remove -R3)</option>
                <option value="egg_remove">Egg (Remove -R4)</option>
                <option value="chili_remove">Chili (Remove -R2)</option>
                <option value="cheese_add">Cheese (Add +R5)</option>
                <option value="mayo_add">Mayo (Add +R5)</option>
                <option value="tomato_add">Tomato (Add +R3)</option>
                <option value="egg_add">Egg (Add +R4)</option>
                <option value="chili_add">Chili (Add +R2)</option>
            </select>
            <p class="price-change" id="price_change_2">Price Change: R0.00</p>
            <p class="updated-price" id="updated_price_2">Updated Price: R60.00</p>
        </div>
    </div>

    <!-- Kota Item: R40 -->
    <div class="kota-item" id="item_3" data-price="40">
        <img src="images/kota3.jpeg" alt="Kota 3">
        <h4>Name: Zani's Signature</h4>
        <p>Price: R40.00</p>
        <a class="order-button" href="cart.php?item=Zani's Signature&price=40">Order Now</a>

        <!-- Ingredient Exclusion -->
        <div class="ingredient-exclusion">
            <label for="exclude_ingredients_3">Select Ingredients to Remove/Add:</label>
            <select id="exclude_ingredients_3">
                <option value="none">-- Select an Ingredient --</option>
                <option value="cheese_remove">Cheese (Remove -R5)</option>
                <option value="mayo_remove">Mayo (Remove -R5)</option>
                <option value="tomato_remove">Tomato (Remove -R3)</option>
                <option value="egg_remove">Egg (Remove -R4)</option>
                <option value="chili_remove">Chili (Remove -R2)</option>
                <option value="cheese_add">Cheese (Add +R5)</option>
                <option value="mayo_add">Mayo (Add +R5)</option>
                <option value="tomato_add">Tomato (Add +R3)</option>
                <option value="egg_add">Egg (Add +R4)</option>
                <option value="chili_add">Chili (Add +R2)</option>
            </select>
            <p class="price-change" id="price_change_3">Price Change: R0.00</p>
            <p class="updated-price" id="updated_price_3">Updated Price: R40.00</p>
        </div>
    </div>

    <!-- Kota Item: R70 -->
    <div class="kota-item" id="item_4" data-price="70">
        <img src="images/kota4.jpeg" alt="Kota 4">
        <h4>Name: Garden Harvest</h4>
        <p>Price: R70.00</p>
        <a class="order-button" href="cart.php?item=Garden Harvest&price=70">Order Now</a>

        <!-- Ingredient Exclusion -->
        <div class="ingredient-exclusion">
            <label for="exclude_ingredients_4">Select Ingredients to Remove/Add:</label>
            <select id="exclude_ingredients_4">
                <option value="none">-- Select an Ingredient --</option>
                <option value="cheese_remove">Cheese (Remove -R5)</option>
                <option value="mayo_remove">Mayo (Remove -R5)</option>
                <option value="tomato_remove">Tomato (Remove -R3)</option>
                <option value="egg_remove">Egg (Remove -R4)</option>
                <option value="chili_remove">Chili (Remove -R2)</option>
                <option value="cheese_add">Cheese (Add +R5)</option>
                <option value="mayo_add">Mayo (Add +R5)</option>
                <option value="tomato_add">Tomato (Add +R3)</option>
                <option value="egg_add">Egg (Add +R4)</option>
                <option value="chili_add">Chili (Add +R2)</option>
            </select>
            <p class="price-change" id="price_change_4">Price Change: R0.00</p>
            <p class="updated-price" id="updated_price_4">Updated Price: R70.00</p>
        </div>
    </div>

    <!-- Kota Item: R130 -->
    <div class="kota-item" id="item_5" data-price="130">
        <img src="images/kota5.jpeg" alt="Kota 5">
        <h4>Name: Firecracker kota</h4>
        <p>Price: R130.00</p>
        <a class="order-button" href="cart.php?item=Firecracker kota&price=130">Order Now</a>

        <!-- Ingredient Exclusion -->
        <div class="ingredient-exclusion">
            <label for="exclude_ingredients_5">Select Ingredients to Remove/Add:</label>
            <select id="exclude_ingredients_5">
                <option value="none">-- Select an Ingredient --</option>
                <option value="cheese_remove">Cheese (Remove -R5)</option>
                <option value="mayo_remove">Mayo (Remove -R5)</option>
                <option value="tomato_remove">Tomato (Remove -R3)</option>
                <option value="egg_remove">Egg (Remove -R4)</option>
                <option value="chili_remove">Chili (Remove -R2)</option>
                <option value="cheese_add">Cheese (Add +R5)</option>
                <option value="mayo_add">Mayo (Add +R5)</option>
                <option value="tomato_add">Tomato (Add +R3)</option>
                <option value="egg_add">Egg (Add +R4)</option>
                <option value="chili_add">Chili (Add +R2)</option>
            </select>
            <p class="price-change" id="price_change_5">Price Change: R0.00</p>
            <p class="updated-price" id="updated_price_5">Updated Price: R130.00</p>
        </div>
    </div>

    <!-- Kota Item: R30 -->
    <div class="kota-item" id="item_6" data-price="30">
        <img src="images/kota6.jpeg" alt="Kota 6">
        <h4>Name: Sunrise Special</h4>
        <p>Price: R30.00</p>
        <a class="order-button" href="cart.php?item=Sunrise Special&price=30">Order Now</a>

        <!-- Ingredient Exclusion -->
        <div class="ingredient-exclusion">
            <label for="exclude_ingredients_6">Select Ingredients to Remove/Add:</label>
            <select id="exclude_ingredients_6">
                <option value="none">-- Select an Ingredient --</option>
                <option value="cheese_remove">Cheese (Remove -R5)</option>
                <option value="mayo_remove">Mayo (Remove -R5)</option>
                <option value="tomato_remove">Tomato (Remove -R3)</option>
                <option value="egg_remove">Egg (Remove -R4)</option>
                <option value="chili_remove">Chili (Remove -R2)</option>
                <option value="cheese_add">Cheese (Add +R5)</option>
                <option value="mayo_add">Mayo (Add +R5)</option>
                <option value="tomato_add">Tomato (Add +R3)</option>
                <option value="egg_add">Egg (Add +R4)</option>
                <option value="chili_add">Chili (Add +R2)</option>
            </select>
            <p class="price-change" id="price_change_6">Price Change: R0.00</p>
            <p class="updated-price" id="updated_price_6">Updated Price: R30.00</p>
        </div>
    </div>

    <!-- Kota Item: R40 -->
    <div class="kota-item" id="item_7" data-price="40">
        <img src="images/kota7.jpeg" alt="Kota 7">
        <h4>Name: Mzanzi Magic</h4>
        <p>Price: R40.00</p>
        <a class="order-button" href="cart.php?item=Mzanzi Magic&price=40">Order Now</a>

        <!-- Ingredient Exclusion -->
        <div class="ingredient-exclusion">
            <label for="exclude_ingredients_7">Select Ingredients to Remove/Add:</label>
            <select id="exclude_ingredients_7">
                <option value="none">-- Select an Ingredient --</option>
                <option value="cheese_remove">Cheese (Remove -R5)</option>
                <option value="mayo_remove">Mayo (Remove -R5)</option>
                <option value="tomato_remove">Tomato (Remove -R3)</option>
                <option value="egg_remove">Egg (Remove -R4)</option>
                <option value="chili_remove">Chili (Remove -R2)</option>
                <option value="cheese_add">Cheese (Add +R5)</option>
                <option value="mayo_add">Mayo (Add +R5)</option>
                <option value="tomato_add">Tomato (Add +R3)</option>
                <option value="egg_add">Egg (Add +R4)</option>
                <option value="chili_add">Chili (Add +R2)</option>
            </select>
            <p class="price-change" id="price_change_7">Price Change: R0.00</p>
            <p class="updated-price" id="updated_price_7">Updated Price: R40.00</p>
        </div>
    </div>

    <!-- Kota Item: R35 -->
    <div class="kota-item" id="item_8" data-price="35">
        <img src="images/kota8.jpeg" alt="Kota 8">
        <h4>Name: Morning Glory</h4>
        <p>Price: R35.00</p>
        <a class="order-button" href="cart.php?item=Morning Glory&price=35">Order Now</a>

        <!-- Ingredient Exclusion -->
        <div class="ingredient-exclusion">
            <label for="exclude_ingredients_8">Select Ingredients to Remove/Add:</label>
            <select id="exclude_ingredients_8">
                <option value="none">-- Select an Ingredient --</option>
                <option value="cheese_remove">Cheese (Remove -R5)</option>
                <option value="mayo_remove">Mayo (Remove -R5)</option>
                <option value="tomato_remove">Tomato (Remove -R3)</option>
                <option value="egg_remove">Egg (Remove -R4)</option>
                <option value="chili_remove">Chili (Remove -R2)</option>
                <option value="cheese_add">Cheese (Add +R5)</option>
                <option value="mayo_add">Mayo (Add +R5)</option>
                <option value="tomato_add">Tomato (Add +R3)</option>
                <option value="egg_add">Egg (Add +R4)</option>
                <option value="chili_add">Chili (Add +R2)</option>
            </select>
            <p class="price-change" id="price_change_8">Price Change: R0.00</p>
            <p class="updated-price" id="updated_price_8">Updated Price: R35.00</p>
        </div>
    </div>

    <script>
        // Price adjustment logic for ingredients (additions and removals)
        const priceAdjustments = {
            cheese_remove: -5,
            mayo_remove: -5,
            tomato_remove: -3,
            egg_remove: -4,
            chili_remove: -2,
            cheese_add: 5,
            mayo_add: 5,
            tomato_add: 3,
            egg_add: 4,
            chili_add: 2
        };

        // Function to update price based on the selected ingredient
        function updatePrice(selectId, basePrice, itemId) {
            const selectedOption = document.getElementById(selectId).value;
            let totalAdjustment = 0;

            // If the user has selected a valid option, apply the corresponding price change
            if (selectedOption !== 'none' && priceAdjustments[selectedOption]) {
                totalAdjustment = priceAdjustments[selectedOption];
            }

            // Calculate the updated price
            const updatedPrice = basePrice + totalAdjustment;

            // Update the price change and the updated price display
            document.getElementById(`price_change_${itemId}`).textContent = `Price Change: R${totalAdjustment >= 0 ? '+' : ''}${totalAdjustment}`;
            document.getElementById(`updated_price_${itemId}`).textContent = `Updated Price: R${updatedPrice.toFixed(2)}`;
        }

        // Add event listener to the ingredient exclusion select dropdowns
        document.querySelectorAll('.ingredient-exclusion select').forEach(select => {
            select.addEventListener('change', function() {
                const selectId = select.id;
                const itemId = selectId.split('_')[2];  // Extract item ID from select ID
                const basePrice = parseFloat(document.querySelector(`#item_${itemId}`).getAttribute('data-price'));
                updatePrice(selectId, basePrice, itemId);
            });
        });

        // Function to handle filter logic
        document.getElementById('filter_button').addEventListener('click', function() {
            const category = document.getElementById('Categories_sp').value;
            const location = document.getElementById('Location_sp').value;

            // Add logic for filtering based on selected category and location here
            alert(`Filtering by ${category} and ${location}`);
        });

        
    </script>

</body>
</html>
