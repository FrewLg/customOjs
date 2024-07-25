<?php
/* Smarty version 4.3.1, created on 2024-07-25 10:51:51
  from 'app:frontendcomponentsuimaterial_theme_selector.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_66a22e472448f4_80717440',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd363ae94793c68ecef8b8dd64f0646c16eaf379' => 
    array (
      0 => 'app:frontendcomponentsuimaterial_theme_selector.tpl',
      1 => 1721847885,
      2 => 'app',
    ),
  ),
  'includes' => 
  array (
    'app:frontend/components/ui/material_icon_light.tpl' => 1,
    'app:frontend/components/ui/material_icon_dark.tpl' => 1,
    'app:frontend/components/ui/material_icon_system.tpl' => 1,
  ),
),false)) {
function content_66a22e472448f4_80717440 (Smarty_Internal_Template $_smarty_tpl) {
?><div>
  <button class="flex h-8 w-8 items-center justify-center rounded-lg shadow-md shadow-black/5 ring-1 ring-black/5 dark:bg-slate-700 dark:ring-inset dark:ring-white/5" aria-label="Theme" id="headlessui-listbox-button-:r1:" type="button" aria-haspopup="listbox" aria-expanded="false" data-headlessui-state="" aria-labelledby="headlessui-listbox-label-:r0: headlessui-listbox-button-:r1:" @click="darkMode = darkMode === 'light' ? 'dark' : darkMode === 'dark' ? 'system' : 'light'">
    <div x-show="darkMode && darkMode == 'light'">
      <?php $_smarty_tpl->_subTemplateRender("app:frontend/components/ui/material_icon_light.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
    <div x-show="darkMode && darkMode == 'dark'">
      <?php $_smarty_tpl->_subTemplateRender("app:frontend/components/ui/material_icon_dark.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
    <div x-show="!darkMode || darkMode === 'system'">
      <?php $_smarty_tpl->_subTemplateRender("app:frontend/components/ui/material_icon_system.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
  </button>
</div>
<?php }
}
