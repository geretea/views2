<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], textarea, select, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Peta</h1>


        <!-- Review Form (Checker) -->
        @if(auth()->user()->role === 'checker' && $document->status === 'review')
    <a href="{{ route('wood-product.data.review', $document->id) }}" class="btn btn-warning">Review Ulang</a>
@endif
        
        <form action="{{ route('wood-product.data.review.submit', $document->id ?? '') }}" method="POST">
            @csrf
            <label for="checker_comments">Checker Comments</label>
            <textarea id="checker_comments" name="checker_comments" placeholder="Add comments" required></textarea>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="review">Review</option>
                <option value="rejected">Reject</option>
            </select>

            <button type="submit">Submit Review</button>
        </form>


        <!-- Success Message -->
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
    </div>
</body>
</html>
