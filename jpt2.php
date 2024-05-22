<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image with Title, Description, and Price</title>
    <style>
        .image-container {
            display: flex;
            gap: 10px;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
        }

        .image-details {
            flex: 1;
        }

        .image-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .image-description {
            font-size: 14px;
            margin-bottom: 5px;
            color: #666;
        }

        .image-price {
            font-size: 16px;
            font-weight: bold;
            color: #f00;
        }
    </style>
</head>
<body>

<div class="image-container">
<img src="pimage/pro.jpg" alt="Icon" width="200    " height="200">
    <div class="image-details">
        <span class="image-title">Product Title</span><br>
        <span class="image-description">Product Description</span><br>
        <span class="image-price">$100</span>
    </div>
</div>

</body>
</html>