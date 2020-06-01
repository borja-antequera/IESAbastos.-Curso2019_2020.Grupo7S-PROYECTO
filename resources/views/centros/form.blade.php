<div class="form-group">
    <label for="">Nombre</label>
    <input type="text" name="centro_nombre" value="{{$centro->centro_nombre}}" class="form-control">
</div>
<div class="form-group">
    <label for="">Dirección</label>
    <input type="text" name="centro_direccion" value="{{$centro->centro_direccion}}" class="form-control">
</div>
<div class="form-group">
    <label for="">Descripción</label>
    <textarea class="form-control" name="centro_descripcion" value="{{$centro->centro_descripcion}}" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="">Slug</label><br>
    <input type="text" name="slug" value="{{$centro->slug}}" class="form-control">
</div>
<div class="form-group">
    <label for="">Imagen</label><br>
    <input type="file" name="centro_imagen">
</div>