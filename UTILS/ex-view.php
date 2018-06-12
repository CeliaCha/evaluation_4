<?php

require_once('model.php');
Database::connect();

class View {
  public static function form_contact () {
    $element =
    "<form action='app.php' method='post'>

      <div class='form-group'>
        <label for='first_name'>Prénom :</label>
        <input required class='form_control' type='text' id='first_name' name='first_name'>
      </div>

      <div class='form-group'>
        <label for='last_name'>Nom :</label>
        <input required class='form_control' type='text' id='last_name' name='last_name'>
      </div>

      <div class='form-group'>
        <label for='birth_year'>Année de naissance :</label>
        <input required type='number' min='1900' id='birth_year' name='birth_year'>
      </div>

      <div class='form-group'>
        <textarea id='comments' name='comments'>Commentaires</textarea>
      </div>

      <input type='submit' action='submit' value='submit_user'>
    </form>";
    echo $element;
  }
}
