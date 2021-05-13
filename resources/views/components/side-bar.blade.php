<!-- This is an example component -->
@inject('Navigation', 'App\Helpers\Navigation')
<div class="min-h-screen bg-white">
    <nav class="h-screen flex flex-col w-96">
        @if (false)
            <ul class="p-24 space-y-2 flex-1 overflow-auto" style="scrollbar-width: thin;">
            @foreach (
                $Navigation->parentMenu as $parentMenuItem
            )
            <!-- Menu Title -->
            <li>
                    @if ( $parentMenuItem['icon'] )
                        {{!!$parentMenuItem['icon']!!}} 
                    @endif
                <div class="mb-3 pt-6">
                    <span class=" text-black font-medium">{{$parentMenuItem['label']}}</span>
                </div>
                <!-- Menu Items -->
                <ul class="space-y-4 flex-1 overflow-auto" id="parent-menu-ul">
                @foreach (
                    $Navigation->childMenu as $menuItem
                )   
                    @if ( $menuItem['parent_slug'] == $parentMenuItem['slug'] && $menuItem['visible'] )
                    <li>
                        <a href="javascript:;" id="menu-item-{{$menuItem['slug']}}" 
                            class="text-sm flex space-x-4 items-center py-2 text-gray-500 transition duration-500 hover:text-opacity-25">
                            @if ( $menuItem['icon'] )
                                {{!!$menuItem['icon']!!}} 
                            @endif
                                <span id="menu-item-label-{{$menuItem['slug']}}">{{ $menuItem['label'] }}</span>
                        </a>
                    </li>
                    @endif
                @endforeach  
                </ul>
            </li>
            @endforeach
            </ul>
        @else
        <ul class="p-14 space-y-4 flex-1 overflow-auto" id="parent-menu-ul">
            @foreach (
                $Navigation->childMenu as $menuItem
            )   
                @if ($menuItem['visible'])
                    <li>
                        <a href="javascript:;" id="menu-item-{{$menuItem['slug']}}" 
                            class="text-sm flex space-x-4 items-center py-2 text-gray-500 transition duration-500 hover:text-opacity-25">
                            @if ( $menuItem['icon'] )
                                {{!!$menuItem['icon']!!}} 
                            @endif
                                <span id="menu-item-label-{{$menuItem['slug']}}">{{ $menuItem['label'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach  
        </ul>
        @endif
    </nav>
</div>