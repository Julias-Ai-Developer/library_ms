<?php if (isset($_SESSION['error'])): ?>
                <div style="background: #ff4444; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div style="background: #00C851; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>