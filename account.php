<?php

session_start(); 
include('server/connection.php'); 

if(!isset($_SESSION['logged_in'])){
    header('location:login.php'); 
    exit; 
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['cart']);
        unset($_SESSION['total']);
        unset($_SESSION['quantity']);
        header('location:login.php'); 
        exit;
    }
}

if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $user_email = $_SESSION['user_email'];

    if($password !== $confirm_password){
        header('location:account.php?error=password do not match');
        exit;
    } else if(strlen($password) < 6){
        header('location:account.php?error=password too short');
        exit;
    } else {
        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?"); 
        $stmt->bind_param('ss', md5($password), $user_email);
        if($stmt->execute()){
            header('location:account.php?register_success=password has been updated successfully'); 
        } else {
            header('location:account.php?register_success=password could not be updated'); 
        }
        exit;
    }
}

if(isset($_SESSION['logged_in'])){
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY order_date DESC");
    $stmt->bind_param('i', $user_id); 
    $stmt->execute();
    $orders = $stmt->get_result();

  
    $stmt_user_total = $conn->prepare("SELECT SUM(order_cost) AS totale FROM orders WHERE user_id = ?");
    $stmt_user_total->bind_param("i", $user_id);
    $stmt_user_total->execute();
    $res_user = $stmt_user_total->get_result();
    $user_total = $res_user->fetch_assoc()['totale'] ?? 0;
//quanti utenti hanno un order cost minore di ? 
    $stmt_rank = $conn->prepare("
        SELECT COUNT(*) AS inferiori FROM (
            SELECT user_id, SUM(order_cost) AS totale_spesa
            FROM orders
            GROUP BY user_id
            HAVING totale_spesa < (
                SELECT SUM(order_cost)
                FROM orders
                WHERE user_id = ?
            )
        ) AS sotto
    ");
    $stmt_rank->bind_param("i", $user_id);
    $stmt_rank->execute();
    $res_rank = $stmt_rank->get_result();
    $utenti_inferiori = $res_rank->fetch_assoc()['inferiori'] ?? 0;

    $stmt_tot = $conn->prepare("SELECT COUNT(DISTINCT user_id) AS totale_utenti FROM orders");
    $stmt_tot->execute();
    $res_tot = $stmt_tot->get_result();
    $totale_utenti = $res_tot->fetch_assoc()['totale_utenti'] ?? 1;

    $percentuale = round(($utenti_inferiori / $totale_utenti) * 100);
}

if (isset($_GET['delete_account'])) {
    $user_id = $_SESSION['user_id'];

    $delete_payments = $conn->prepare("DELETE FROM payments WHERE order_id IN (SELECT order_id FROM orders WHERE user_id = ?)");
    $delete_payments->bind_param("i", $user_id);
    $delete_payments->execute();

    $delete_items = $conn->prepare("DELETE FROM order_items WHERE order_id IN (SELECT order_id FROM orders WHERE user_id = ?)");
    $delete_items->bind_param("i", $user_id);
    $delete_items->execute();

    $delete_orders = $conn->prepare("DELETE FROM orders WHERE user_id = ?");
    $delete_orders->bind_param("i", $user_id);
    $delete_orders->execute();

    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        session_unset();
        session_destroy();
        header('Location: register.php?message=Account eliminato con successo');
        exit;
    } else {
        header("Location: account.php?error=Errore durante l'eliminazione dell'account");
        exit;
    }
}
?>

<?php include('layouts/header.php'); ?>

<section class="my-5 py-3">
  <div class="row container mx-auto">
    <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
      <h3 class="font-weight-bold">Account overview</h3>
      <p class="text-center" style="color:green"> <?php if(isset($_GET['register_success'])){echo $_GET['register_success'];} ?></p>
      <p class="text-center" style="color:green"> <?php if(isset($_GET['login_success'])){echo $_GET['login_success'];} ?></p>
      <hr class="mx-auto">
      <div class="account-info">
        <p>Name <span><?php echo $_SESSION['user_name']; ?></span></p>
        <p>Email <span><?php echo $_SESSION['user_email']; ?></span></p>
        <p><a href="#orders" id="orders-btn">View your orders</a></p>
        <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
        <p><a href="account.php?delete_account=1" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');" style="color: #ff5733; text-decoration: none;font-size: 0.9rem;">Delete account</a></p>

      </div>
    </div>

    <div class="col-lg-6 col-md-12 col-sm-12">
      <form id="account-form" method="POST" action="account.php">
        <p class="text-center" style="color:red"> <?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
        <p class="text-center" style="color:green"> <?php if(isset($_GET['message'])){echo $_GET['message'];} ?></p>
        <h3>Change password</h3>
        <hr class="mx-auto">
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
          <label>Confirm password</label>
          <input type="password" class="form-control" name="confirm-password" placeholder="Password">
        </div>
        <div class="form-group">
          <input type="submit" value="Update password" name="change_password" class="btn" />
        </div>
      </form>
    </div>
  </div>

       
</section>

<!-- Orders Section -->
<section id="orders" class="orders container my-1 py-1">
  <div class="container mt-1">
    <h2 class="font-weight-bold text-center">Your orders</h2>
    <hr class="mx-auto">
  </div>
  <div class="mt-4 card border-0 shadow-sm">
          <div class="card-body text-center">
            <h6 class="card-title text-muted">Classifica personale</h6>
            <p class="card-text fs-5">
              You have ordered more than <strong><?php echo $percentuale; ?>%</strong> of our customers.
            </p>
          </div>
        </div>
  <div class="table-responsive">
    <table class="table table-hover mt-4 text-center">
      <thead class="table-dark">
        <tr>
          <th>Order Id</th>
          <th>Costo</th>
          <th>Status</th>
          <th>Data</th>
          <th>Info</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if ($orders && $orders->num_rows > 0) {
          while ($row = $orders->fetch_assoc()) { ?>
            <tr class="align-middle">
              <td><?php echo htmlspecialchars($row['order_id']); ?></td>
              <td class="text-success fw-bold">€<?php echo htmlspecialchars($row['order_cost']); ?></td>
              <td>
                <span class="badge bg-<?php echo ($row['order_status'] == 'Completed') ? 'success' : 'warning'; ?>">
                  <?php echo htmlspecialchars($row['order_status']); ?>
                </span>
              </td>
              <td><?php echo htmlspecialchars($row['order_date']); ?></td>
              <td>
                <a href="order_details.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-orange" id="details_btn">
                  Details
                </a>
              </td>
            </tr>
          <?php }
        } else { ?>
          <tr>
            <td colspan="5" class="text-muted py-4">No orders yet</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>

<?php include('layouts/footer.php'); ?>
