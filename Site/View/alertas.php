<?php if (isset($_SESSION['msg_sucesso']) && $_SESSION['msg_sucesso']): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['msg_sucesso']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['msg_sucesso']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['msg_erro']) && $_SESSION['msg_erro']): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['msg_erro']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['msg_erro']); ?>
<?php endif; ?>