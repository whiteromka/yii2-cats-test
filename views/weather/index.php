<?php
 /** @var array $data */
?>
<h1>Weather</h1>


<div class="card">
    <div class="card-body">
        <h5 class="card-title">Погода в регионе ....</h5>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Широта</th>
                <th scope="col">Долгота</th>
                <th scope="col">Сезон</th>
                <th scope="col">т</th>
                <th scope="col">напр ветра</th>
                <th scope="col">скор ветра</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th> <?= $data['lat']?> </th>
                <td><?= $data['lon']?></td>
                <td><?= $data['season']?></td>
                <td><?= $data['temp']?></td>
                <td><?= $data['winDir']?></td>
                <td><?= $data['winSpeed']?></td>
            </tr>
            </tbody>
        </table>

    </div>
</div>