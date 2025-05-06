# 💳 Payment Gateway Integration (Basic Project)

A simple project demonstrating how to integrate a bKash payment gateway using Laravel and MySql.

---

## 🚀 Features

- Payment initiation
- Callback/response handling
- Payment success/failure redirection
- Logging payment status
- Basic frontend for testing payment


---

## 📁 Project Structure

<pre><code> ``` project-root/ ├── routes/ │ └── web.php # Laravel route definitions ├── app/ │ └── Http/ │ └── Controllers/ │ └── PaymentController.php # Handles payment logic │ └── OrderController.php # Handles order processing │ └── RefundController.php # Handles refunds ├── resources/ │ └── views/ │ └── order/ │ └── index.blade.php # Displays order list with transactions │ └── show.blade.php # Shows bKash button for specific order │ └── transaction/ │ └── index.blade.php # Shows detailed transaction info │ └── show.blade.php # Shows bKash button for specific transaction │ └── payment.blade.php # Payment form UI ├── .env # Payment credentials └── README.md # Project documentation ``` </code></pre>

## ⚙️ Environment Setup

1. Clone the repository:
   
   git clone https://github.com/yourusername/payment-gateway-project.git
   cd payment-gateway-project
2. Install dependencies:
    composer install
3. Generate app key:
    php artisan key:generate
4. Migrate all tables:
    php artisan migrate
5. Run the server:
    php artisan serve
## Testing the payment
- Open your browser and go to http://127.0.0.1:8000/orders
- Click on view button 
- Click on the "pay with bkash button'
- use the sandbox wallet numbers(01619777282, OTP- 123456, PIN - use recent correct PIN by communicating with concerned person from technical team of bKash)

# Disclaimer
- This is a demo presentation of bKash PGW integration with Regular Checkout or Checkout iFrame, Do not follow this code for production level.
- Update your code token limitation as per bKash guidelines

🙋‍♂️ Author- Muhammad Iqbal Hossain 

