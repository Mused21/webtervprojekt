<?php

  function loadUsers() {
    $users = [];
    $file = fopen("users.txt", "r");

    if ($file === FALSE) {
      die("ERROR: File could not be opened");
    }

    while (($line = fgets($file)) !== FALSE) {
      $user = unserialize($line);
      $users[] = $user;
    }

    fclose($file);
    return $users;
  }

  function saveUsers($users) {
    $file = fopen("users.txt", "w");

    if ($file === FALSE) {
      die("ERROR: File could not be opened");
    }

    foreach($users as $user) {
      $serialized_user = serialize($user);
      fwrite($file, $serialized_user . "\n");
    }

    fclose($file);
  }

  function deleteUser($user) {
    $extensions = ["png", "jpg", "jpeg"];
    $picpath = "profile_pics/" . $user["email"];
    foreach ($extensions as $extension) {
      if (file_exists($picpath . "." . $extension)) {
        $profile_pic = $picpath . "." . $extension;
      }
    }

    $toRemove = serialize($user);
    $lines = file("users.txt", FILE_IGNORE_NEW_LINES);
    foreach($lines as $key => $line) {
        if($line === $toRemove) {
          unset($lines[$key]);
        }
    }
    $data = implode(PHP_EOL, $lines);
    file_put_contents("users.txt", $data);

    if (isset($profile_pic)) {
      unlink($profile_pic);
    }
  }

  function findUserByEmail($email) {
    $users = loadUsers("users.txt");
    foreach ($users as $user) {
      if ($user['email'] === $email) {
        return $user;
      }
    }
    return NULL;
  }

  function blockUser($toBlock) {
    $users = loadUsers("users.txt");
    foreach ($users as &$user) {
      if ($user['email'] === $toBlock['email']) {
        $user['block'] = TRUE;
      }
    }
    saveUsers($users);
  }

  function unblockUser($toUnblock) {
    $users = loadUsers("users.txt");
    foreach ($users as &$user) {
      if ($user['email'] === $toUnblock['email']) {
        $user['block'] = FALSE;
      }
    }
    saveUsers($users);
  }

  function isFilled($field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === "") {
      return false;
    }
    return true;
  }

  function isNotFilled($field) {
    return !isFilled($field);
  }

  function uploadProfilePicture($email) {
    global $uploadError;

    if (isset($_FILES["pic"]) && is_uploaded_file($_FILES["pic"]["tmp_name"])) {
      $allowed_extensions = ["png", "jpg", "jpeg"];
      $extension = strtolower(pathinfo($_FILES["pic"]["name"], PATHINFO_EXTENSION));

      if (in_array($extension, $allowed_extensions)) {
        if ($_FILES["pic"]["error"] === 0) {
          if ($_FILES["pic"]["size"] <= 31457280) {
            $path = "profile_pics/" . $email . "." . $extension;

            if (!move_uploaded_file($_FILES["pic"]["tmp_name"], $path)) {
              $uploadError = "Cannot move the file!";
            }
          } else {
            $uploadError = "File should be less than 30 MB!";
          }
        } else {
          $uploadError = "Upload failed!";
        }
      } else {
        $uploadError = "Not supported extension!";
      }
    }
  }
?>
