<?php include "header.php"; ?>
<style>
    .container {
  display: flex;
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.seat-map, .details {
  margin: 10px;
}

.legend {
  display: flex;
  gap: 10px;
  margin-bottom: 10px;
}

.legend div {
  display: flex;
  align-items: center;
}

.legend span {
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-right: 5px;
  border-radius: 4px;
}

.available {
  background: #e0e0e0;
}

.selected {
  background: #4caf50;
}

.sold {
  background: #f44336;
}

.seats {
  display: grid;
  grid-template-columns: repeat(4, 80px);
  gap: 10px;
}

.seat {
  width: 60px;
  height: 60px;
  background: #e0e0e0;
  border-radius: 4px;
  text-align: center;
  line-height: 50px;
  cursor: pointer;
}

.seat.sold {
  background: #f44336;
  cursor: not-allowed;
}

.seat.selected {
  background: #4caf50;
}

.details {
  width: 300px;
}

form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

button {
  background: #4caf50;
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
  border-radius: 4px;
}

button:hover {
  background: #45a049;
}
</style>
<div class="container">
    <div class="col-md-6 d-flex justify-content-end">
        <div class="seat-map">
        <div class="legend">
            <div><span class="available"></span> Available</div>
            <div><span class="selected"></span> Selected</div>
            <div><span class="sold"></span> Sold</div>
        </div>
           
        <div class="seats">
                <!-- Seats will be dynamically generated here -->
        </div>
        
        </div>
        <div class="vr"></div>
    </div>
    
    <div class="col-md-6 d-flex justify-content-center">
    <div class="details">
      
      <h3>Seat Details</h3>
      <div class="selected-seats">
        <p>Seats: <span id="seat-numbers"></span></p>
        <?php include "config.php";
          $bus_id=$_GET['bus_id'];
         $sql="SELECT cost FROM bus_info INNER JOIN route ON bus_info.route_id=route.r_id  WHERE id=?";
         $pdostmt=$dbConn->prepare($sql);
           $pdostmt->bindParam(1,$bus_id);
           $pdostmt->execute();
           $row=$pdostmt->fetch(PDO::FETCH_ASSOC);
            
           ?>
            
        
        <p>Total:<span id="total-price"> ৳ </span></p>
        <!-- <p>Total Seat: ৳ <span id="">0</span></p> -->
      </div>

      <form action="payment.php" method="POST" id="booking-form">
        <input type="text" id="totalseat" name="seat_number" hidden>
        <input type="number" id="totalseat" name="total" placeholder="totalseat">
        <input type="text" id="price" name="price" hidden>
        <input type="number" id="" name="bus_id" value="<?php echo $_GET['bus_id']; ?>" hidden>
        <input type="text" id="full-name" placeholder="Full Name" name="username" class="form-control" required>
       
        <input type="text" id="phone-number" placeholder="Mobile Number" name="mobile" class="form-control" required>
      
        <label for="gender">Gender*</label>
        <select id="gender" name="gender" class="form-control">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
        </select>
       <label for="pickup" >Pick Up*</label>
        <select id="pickup" name="pick" class="form-control">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Others">Others</option>
        </select>
        <input type="submit" name="submit" value="Continue">
       </form>
    </div>
    </div>
  </div>
<script>
    const seatsContainer = document.querySelector('.seats');
    const seatNumbersDisplay = document.getElementById('seat-numbers');
    const totalPriceDisplay = document.getElementById('total-price');
    const seatPrice =<?php echo $row['cost'];?> ;
   
    // Dummy data for seats (sold status)
    const seats = [
    ['A1', false], ['A2', false], ['A3', false], ['A4', true],
    ['B1', false], ['B2', false], ['B3', true], ['B4', false],
    ['C1', false], ['C2', false], ['C3', false], ['C4', false],
    ['D1', false], ['D2', false], ['D3', false], ['D4', true],
    ];

    let selectedSeats = [];

    // Render seats
    seats.forEach(([seatNumber, sold]) => {
    const seat = document.createElement('div');
    seat.className = `seat ${sold ? 'sold' : ''}`;
    seat.textContent = seatNumber;
    seat.addEventListener('click', () => selectSeat(seatNumber, seat, sold));
    seatsContainer.appendChild(seat);
    });

    // Select seat function
    function selectSeat(seatNumber, seatElement, sold) {
    if (sold) return;

    if (selectedSeats.includes(seatNumber)) {
        selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
        seatElement.classList.remove('selected');
    } else {
        selectedSeats.push(seatNumber);
        seatElement.classList.add('selected');
    }

      updateDetails();
    }

    
    

    // Update seat details
    function updateDetails() {
    seatNumbersDisplay.textContent = selectedSeats.length ? selectedSeats.join(', ') : 'None';
    totalPriceDisplay.textContent = selectedSeats.length * seatPrice;
    document.getElementById("totalseat").value = seatNumbersDisplay.textContent = selectedSeats.length ? selectedSeats.join(', ') : 'None';

document.getElementById("price").value = totalPriceDisplay.textContent = selectedSeats.length * seatPrice;
    
    }

</script>
<?php include "footer.php"; ?>