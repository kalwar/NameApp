<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Name and Color Form</title>
  <style>
  body {
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
  }

  .container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
  }

  h2,
  h3 {
    color: #333;
    text-align: center;
  }

  .message {
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
  }

  .success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  .error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  label {
    display: block;
    margin-bottom: 5px;
    color: #555;
  }

  input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type="text"]:focus {
    border-color: #4a90e2;
    outline: none;
  }

  .error-text {
    color: #dc3545;
    font-size: 0.85em;
    margin-top: -8px;
    margin-bottom: 10px;
  }

  button {
    width: 100%;
    padding: 10px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button:hover {
    background-color: #357abd;
  }

  ul {
    list-style: none;
    padding: 0;
    margin-top: 20px;
  }

  li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 4px;
    margin-bottom: 8px;
  }

  a,
  .delete-btn {
    color: #4a90e2;
    text-decoration: none;
    margin-right: 15px;
  }

  a:hover,
  .delete-btn:hover {
    color: #357abd;
    text-decoration: underline;
  }

  .delete-btn {
    color: #dc3545;
    background: none;
    border: none;
    cursor: pointer;
  }

  .delete-btn:hover {
    color: #a71d2a;
  }
  </style>
</head>

<body>
  <div class="container">
    <h2>Enter Name and Color</h2>

    <!-- Display success/error messages -->
    <?php if(session('success')): ?>
    <div class="message success">
      <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
    <div class="message error">
      <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <!-- Form for adding or editing -->
    <form action="<?php echo e(isset($edit_id) ? route('name.update', $edit_id) : route('name.store')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <?php if(isset($edit_id)): ?>
      <?php echo method_field('PUT'); ?>
      <?php endif; ?>
      <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo e(old('name', isset($edit_name) ? $edit_name : '')); ?>">
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="error-text"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div>
        <label for="color">Color</label>
        <input type="text" name="color" id="color" value="<?php echo e(old('color', isset($edit_color) ? $edit_color : '')); ?>">
        <?php $__errorArgs = ['color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="error-text"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <button type="submit"><?php echo e(isset($edit_id) ? 'Update' : 'Submit'); ?></button>
    </form>

    <!-- List of names -->
    <?php if(!empty($names)): ?>
    <h3>Stored Names</h3>
    <ul>
      <?php $__currentLoopData = $names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li>
        <span style="color: <?php echo e($entry['color']); ?>"><?php echo e($entry['name']); ?></span>
        <div>
          <a href="<?php echo e(route('name.edit', $index)); ?>">Edit</a>
          <form action="<?php echo e(route('name.destroy', $index)); ?>" method="POST" style="display: inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="delete-btn"
              onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
          </form>
        </div>
      </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>
  </div>
</body>

</html><?php /**PATH /Users/sk/Herd/NameApp/resources/views/name.blade.php ENDPATH**/ ?>