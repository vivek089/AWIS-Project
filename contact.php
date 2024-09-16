<?php include 'header.php'; ?>

<div class="bottomAbout" id="call-contact">
            <h1>Contact Information</h1><br>
            <div class="contact-info">
                <p><i class="fa-solid fa-phone"></i>&nbsp; <b>02 9266 9583</b></p><br>
                <p><i class="fa-regular fa-envelope"></i>&nbsp; <a href="mailto:help@bookevent.com.au"><b>help@bookevent.com.au</b></a></p><br>
                <p>Main Office: <b>58 Druitt St, Sydney 2000</b></p><br><br>
                <h3>OR</h3><br>
            </div>
        
            <h3>Send Us a Direct Message Here!</h3><br><br>
            <div class="form-container">
                <form action="submit.php" method="post">
                    <label for="fullName">Full Name:</label>
                    <input type="text" id="fullName" name="fullName" required>
        
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
        
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required inputmode="numeric" pattern="[0-9]*">

        
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required maxlength="5000" placeholder="Write your concerns here"></textarea>
        
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>

<?php include 'footer.php'; ?>
