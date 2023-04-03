<?php
session_start();
echo "";
?>	
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard</title>
        <link rel="stylesheet" href="/assets/Dashboard.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    </head>
    <body>
    <div class="nav">
    <div class="logo">
      <img src="/assets/logo-black.svg" alt="logo">
      </div>
    </div>
    <div class="d-flex justify-content-center container p-4">
    <div class="w-100 p-4 h-100">
      <div class="card-hover-shadow-2x mb-3 card">
        <div class="card-header-tab card-header">
          <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
              class="fa fa-tasks"></i>&nbsp;Task Lists</div>
        </div>
        <div class="scroll-area-sm">
          <perfect-scrollbar class="ps-show-limits">
            <div style="position: static;" class="ps ps--active-y">
              <div class="ps-content">
                <ul class=" list-group list-group-flush">
                  <li class="list-group-item">
                    <div class="todo-indicator bg-warning"></div>
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-2">
                          <div class="custom-checkbox custom-control">
                            <input class="custom-control-input"
                              id="exampleCustomCheckbox12" type="checkbox"><label class="custom-control-label"
                              for="exampleCustomCheckbox12">&nbsp;</label>
                            </div>
                        </div>'?>
                        <?php
                        foreach($_SESSION["user"]["tasks"] as $task){}
                          echo '';
                          ?>
                          <div class="widget-content-left p-5">
                          <div class="widget-heading">'.$task["task_description"].'<div class="badge badge-danger ml-2">Rejected</div>
                          </div>
                          <div class="widget-subheading"><i>'.$task["task_name"].'</i></div>
                        </div>
                      <div class="widget-content-right">
                        <a class="border-0 btn-transition btn btn-outline-success" href="/src/controllers/TaskController?task_complete='.$task["task_id"].'">
                          <i class="fa fa-check"></i></a>
                        <a class="border-0 btn-transition btn btn-outline-primary" href="./upDateTask/?task_id='.$task["task_id"].'">
                          <i class="fa fa-edit"></i></a>
                          <a class="border-0 btn-transition btn btn-outline-danger" href="/src/controllers/TaskController?task_delete='.$task["task_id"].'">
                         <i class="fa fa-trash"></i>
                         <i class="fa fa-envelope-open" aria-hidden="true">
                         <a class="border-0 btn-transition btn btn-outline-danger" href="../views/AddReminder.php?task_id='.$task["task_id"].'">
                         </i>

                        </a>
                      </div>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                        </div>
                          ';
                        ?>
                        <?php
                        echo '';
                        ?>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </perfect-scrollbar>
        </div>
        <div class="d-block w-100 text-right card-footer d-flex justiy-content-center"><a class="mr-2 btn btn-warning" href="/src/views/CompletedTasks.php">Get Compelted Tasks</a>
        <a class="btn btn-primary" href="/src/views/AddTask.php">Add Task</a></div>
      </div>
    </div>
    </div>
    <div class="d-flex justify-content-center container p-4">
    <div class="w-100 p-4 h-100">
    <a class="btn btn-danger" href="../controllers/LoginController/?logout=true">Logout</a>
    </div>
    </body>';

?>