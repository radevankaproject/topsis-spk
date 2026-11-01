<?php
// route/web.php

function routes($m, $r)
{
  global $db;
  global $base_url;
  global $criterias;
  global $alternativesList;
  global $criteriaList;

  // Pastikan user sudah login
  if (empty($_SESSION['username']) || empty($_SESSION['level'])) {
    header('Location: ' . base_url('login'));
    exit();
  }

  // Selain Admin (level != 1) hanya boleh mengakses alternative/add
  if ((int)$_SESSION['level'] !== 1 && !($m === 'alternative' && $r === 'add')) {
    header('Location: ' . base_url('alternative/add'));
    exit();
  }

  // --- PENANGANAN HOME/DASHBOARD (Khusus Admin) ---
  if (empty($m) && empty($r)) {
    require_once __DIR__ . '/../app/controllers/TopsisCalculator.php';
    $topsis = new TopsisCalculator($db);
    $dashboardData = $topsis->getDashboardData();

    $rankingResults = $dashboardData['rankingResults'] ?? [];
    $criteriaInfo = $dashboardData['criteriaInfo'] ?? [];
    $criteriaTypes = $dashboardData['criteriaTypes'] ?? [];

    return include "app/views/home/home.php";
  }

  switch ($m) {
    case 'alternative':
      if ($r == 'add') {
        require_once __DIR__ . '/../app/controllers/AlternativeControllers.php';
        showAlternativeForm();
        return include "app/views/alternative/$r.php";
      } elseif ($r == 'list') {
        if ((int)$_SESSION['level'] !== 1) {
          header('Location: ' . base_url('alternative/add'));
          exit();
        }
        require_once __DIR__ . '/../app/controllers/AlternativeControllers.php';
        getAlternativeDataForList();
        return include "app/views/alternative/$r.php";
      }
      break;

    case 'topsis':
      if ($r == 'results') {
        if ((int)$_SESSION['level'] !== 1) {
          header('Location: ' . base_url('alternative/add'));
          exit();
        }

        require_once __DIR__ . '/../app/controllers/TopsisCalculator.php';
        $topsis = new TopsisCalculator($db);
        $topsisData = $topsis->calculate();

        $rankingResults = $topsisData['rankingResults'] ?? [];
        $idealPositive  = $topsisData['idealPositive'] ?? [];
        $idealNegative  = $topsisData['idealNegative'] ?? [];
        $allUsersData   = $topsisData['allUsers'] ?? [];
        $detailMatrices = $topsisData['detailMatrices'] ?? [];
        $criteriaInfo   = $topsisData['criteriaInfo'] ?? [];

        if (!isset($topsisData['error'])) {
          $topsis->saveRankingResults($rankingResults);
        }

        return include "app/views/topsis/$r.php";
      }
      break;

    case 'users':
    case 'criteria':
    case 'dashboard':
      if ((int)$_SESSION['level'] !== 1) {
        header('Location: ' . base_url('alternative/add'));
        exit();
      }
      return include "app/views/$m/$r.php";
      break;

    default:
      header("HTTP/1.0 404 Not Found");
      exit('Page not found');
  }
}
