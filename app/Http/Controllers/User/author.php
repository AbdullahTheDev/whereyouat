<form id="luluOrderForm" enctype="multipart/form-data">
    <h3>Book Details</h3>
    <label>Title: <input type="text" value="The Great Gatsby" name="title" required></label><br>
    <label>Quantity: <input type="number" name="quantity" min="1" value="1" required></label><br>

    <label>Upload Cover (PDF, PNG, JPG): 
        <input type="file" name="cover" accept=".pdf,.png,.jpg,.jpeg" required>
    </label><br>

    <label>Upload Interior (PDF only): 
        <input type="file" name="interior" accept=".pdf" required>
    </label><br>

    <label>Choose Book Format:</label>
    <select id="book_format" name="package_id" required>
        <option value="0600X0900BWSTDPB060UW444MXX">6x9" Paperback (B&W)</option>
        <option value="0700X1000FCPRECO060UC444MXX">8.5x11</option>
        <option value="0600X0900FCSTDPB080CW444GXX">8.5x9 </option>
        <option value="0850X1100BWSTDLW060UW444MNG">IDK</option>
    </select>

    <h3>Shipping Details</h3>
    <label>Name: <input type="text" name="name"value="John Doe" required></label><br>
    <label>Email: <input type="email" name="email" value="john@example.com" required></label><br>
    <label>Phone: <input type="tel" name="phone" pattern="\+?\d{10,15}" placeholder="+1234567890" value="+1234567890" required></label><br>
    <label>Street: <input type="text" name="street" value="123 Main St" required></label><br>
    <label>City: <input type="text" value="New York" name="city" required></label><br>
    <label>State (US Only): 
        <select name="state" required>
            <option value="">Select State</option>
            <option value="NY" selected>New York</option>
            <option value="CA">California</option>
            <option value="TX">Texas</option>
            <option value="FL">Florida</option>
            <option value="IL">Illinois</option>
            <!-- Add more states as needed -->
        </select>
    </label><br>
    <label>Postcode: <input type="text" name="postcode" value="10001" pattern="\d{5}" placeholder="12345" required></label><br>
    <label>Country Code (ISO 2-letter): <input type="text" value="US" name="country" pattern="[A-Z]{2}" placeholder="US" required></label><br>

    <label>Shipping Level: 
        <select name="shipping_level" required>
            <option selected value="MAIL">Mail</option>
            <option value="PRIORITY">Priority</option>
        </select>
    </label><br>

    <button type="submit">Place Order</button>
</form>


<div id="responseMessage"></div>
