<?php

if (!function_exists('build_category_tree'))
{
    /**
     * Monta uma árvore hierárquica de categorias.
     * 
     * @param array $categories Lista de categorias vindas do banco.
     * @param int $parentId ID da categoria pai (0 = raiz).
     * @return array
     */
    function build_category_tree(array $categories, int $parentId = 0): array
    {
        $branch = [];

        foreach ($categories as $category)
        {
            /**
             * Corrigir se o campo for "parent_id" ao invés de "parent"
             */
            $currentParent = (int) ($category['parent'] ?? 0);

            if ($currentParent === $parentId)
            {
                $children = build_category_tree($categories, (int) $category['id']);
                $category['children'] = $children;
                $branch[] = $category;
            }
        }

        return $branch;
    }
}
