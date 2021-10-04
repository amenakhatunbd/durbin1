@foreach($sub_menus as $sub_menu)

    <?php 
   // dd($sub_menu);
    
    ?>


    <li class="mega-dropdown">
        <a href="{{ url('category',$sub_menu->slug ) }}">{{ $sub_menu->title }} </a>
    </li>
@endforeach
