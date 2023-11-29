
    <option value="{{ $category->id }}">
        
        {{ $category->name }}
        
        @foreach($category->children as $child)
            <x-category :category="$child" /> 
        @endforeach   
    </option>
        
    
                                  
    


                                                    
                                        
                                               