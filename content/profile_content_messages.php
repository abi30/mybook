<div style="display :flex;">
        <!--friends area-->
        <div style="min-height:400px;flex:1;">
            <div id="friends_bar">
                <?php
                if (!empty($_GET['section']) && $_GET['section'] == 'messages') {
                    $new_msg = $post->getInboxNewMessage();
                    $inbox = "Inbox";
                    if($new_msg > 0){
                        $inbox = "Inbox(<span style='color:red'>$new_msg</span>)";
                    }
                    ?>
                    <ul>
                        <li><a href="profile.php?section=messages&view=inbox"><?php echo $inbox; ?></a></li>
                        <li><a href="profile.php?section=messages">Compose</a></li>
                        <li><a href="profile.php?section=messages&view=sent">Sent List</a></li>
                    </ul>
                    <?php
                } else {
                    ?>
                    Friends <br>
                    <?php
                    if ($friends) {
                        foreach ($friends as $FRIEND_ROW) {
                            include('user.php');
                        }
                    }
                }
                ?>
            </div>
        </div>
        <!--posts area-->
        <div style="min-height:400px;flex:2.5;padding : 20px ;padding-right:0px;">
            <?php
            if (isset($_POST['btnMessageSent'])) {
                $post->savePersonalMessage($_POST);
            }
            if (!empty($_SESSION['alert_msg'])) {
                ?>
                <div class="alert alert-<?php echo $_SESSION['alert_type']; ?> alert-dismissible fade show">
                    <?php echo $_SESSION['alert_msg']; ?>
                </div>
                <?php
                unset($_SESSION['alert_type']);
                unset($_SESSION['alert_msg']);
            }
            if (!empty($_GET['section']) && $_GET['section'] == 'messages') {
                if (!empty($_GET['view']) && $_GET['view'] == 'inbox') {
                    ?>
                    <div style="background: #fff;">
                        <div style="padding: 10px 20px">
                            <h3>Inbox</h3>
                            <table class="table table-bordered">
                                <thead>
                                <th>#</th>
                                <th>From</th>
                                <th>Message</th>
                                </thead>
                                <tbody>
                                <?php
                                $list_inbox = $post->getInboxMessage();
                                if (!empty($list_inbox)) {
                                    $sl=1;
                                    $count_new = [];
                                    foreach ($list_inbox as $row) {
                                        $bg = '';
                                        if($row['read_status']==0){
                                            $bg = "style='background:#e8f0fc'";
                                            $count_new[] = $row['id'];
                                        }
                                        ?>
                                        <tr <?php echo $bg;?>>
                                            <td><?php echo $sl++;?></td>
                                            <td><?php echo $row['fullname'];?></td>
                                            <td><?php echo $row['message_text'];?></td>
                                        </tr>
                                        <?php
                                    }
                                    if(!empty($count_new)){
                                      $post->changeReadStatus($count_new);
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3">Data not available!</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                } else if (!empty($_GET['view']) && $_GET['view'] == 'sent') {
                    ?>
                    <div style="background: #fff;">
                        <div style="padding: 10px 20px">
                            <h3>Sent List</h3>
                            <table class="table table-bordered">
                                <thead>
                                <th>#</th>
                                <th>To</th>
                                <th>Message</th>
                                </thead>
                                <tbody>
                                <?php
                                $list_inbox = $post->getSentMessage();
                                if (!empty($list_inbox)) {
                                    $sl=1;
                                    foreach ($list_inbox as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $sl++;?></td>
                                            <td><?php echo $row['fullname'];?></td>
                                            <td><?php echo $row['message_text'];?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3">Data not available!</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div style="background: #fff;">
                        <form method="post" action="">
                            <div style="padding: 10px 20px">
                                <select class="form-control" name="to_userid" required>
                                    <option value="">-Select-</option>
                                    <?php
                                    $list = $post->userList();
                                    if (!empty($list)) {
                                        foreach ($list as $row) {
                                            ?>
                                            <option value="<?php echo $row['userid']; ?>"><?php echo $row['fullname']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <textarea name="message_details"
                                          style="border:1px solid #ddd;border-radius: 2px;margin: 5px 0px;height:80px" required></textarea>
                                <button type="submit" name="btnMessageSent" id="post_button" style ="min-width:100px">Message Sent 
                                </button>
                                <br> <br>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            } else
             {
                ?>
                <div style="border:solid thin #aaa; padding:10px;background-color:white;">
                    <form method="POST" action="" enctype="multipart/form-data">
                    <textarea name="post" placeholder="whats on your mind ?" name="" id="" cols="30"
                              ROWs="5"></textarea>
                        <input type="file" name="file">
                        <input type="submit" name="btnSubmitPost" id="post_button" value="post">
                        <br> <br>
                    </form>
                </div>
                <!-- post_bar-->
                <div id="post_bar">
                    <?php
                    if ($posts) {
                        foreach ($posts as $ROW) {
                            $user = new User();
                            $ROW_USER = $user->get_user($ROW['userid']);
                            include('post.php');
                        }
                    }
                    ?>
                </div>
            <?php } ?>

            
        </div>
    </div>