<?php

namespace Application\Service;

use Application\Utils\StringConversion;

class Export
{
   public function exportExcel($filter, $name = 'Listagem')
    {
        if ($filter instanceof \Zend\Db\ResultSet\HydratingResultSet) {
            $filter = iterator_to_array($filter->getDataSource());
        }
        
        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();
        
        // Definimos o estilo da fonte
        
        $num_registros = count($filter);
        if($num_registros > 0 ) {

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $campos = [];
            $count = 0;
    
            foreach ($filter[0] as $chave => $fields)
            {
                $campos[] =  StringConversion::indexToTitle($chave);
                $normalizeField[] = $chave;
                
            }
            
            foreach ($this->returnRange(count($filter[0])) as $column_key) {
                $objPHPExcel->getActiveSheet()->getStyle($column_key.'1')->getFont()->setBold(true);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($column_key.'1', $campos[$count]);
                if($column_key != 'A') 
                    $objPHPExcel->getActiveSheet()->getColumnDimension($column_key)->setWidth(30);
                $count++;    
            }
            $row=2;
            foreach($filter as $linha) {
                for($i = 0 ; $i < count($normalizeField); $i++) {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, $row, $linha[$normalizeField[$i]]);
                }
                $row++;
            }
        } else {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "Não existem registros para serem exibidos !");
        }    
        // Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
        $objPHPExcel->getActiveSheet()->setTitle($name);
        
        // Cabeçalho do arquivo para ele baixar
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . StringConversion::titleToIndex($name) . '.xls"');
        header('Cache-Control: max-age=0');
        // Se for o IE9, isso talvez seja necessário
        header('Cache-Control: max-age=1');
        
        // Acessamos o 'Writer' para poder salvar o arquivo
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        
        // Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
        $objWriter->save('php://output'); 
        
        exit;
    }

    protected function createColumnsArray($end_column, $first_letters = '')
    {
        $columns = array();
        $length = strlen($end_column);
        $letters = range('A', 'Z');

        // Iterate over 26 letters.
        foreach ($letters as $letter) {
            // Paste the $first_letters before the next.
            $column = $first_letters . $letter;

            // Add the column to the final array.
            $columns[] = $column;

            // If it was the end column that was added, return the columns.
            if ($column == $end_column)
                return $columns;
        }

        // Add the column children.
        foreach ($columns as $column) {
            // Don't itterate if the $end_column was already set in a previous itteration.
            // Stop iterating if you've reached the maximum character length.
            if (!in_array($end_column, $columns) && strlen($column) < $length) {
                $new_columns = $this->createColumnsArray($end_column, $column);
                // Merge the new columns which were created with the final columns array.
                $columns = array_merge($columns, $new_columns);
            }
        }

        return $columns;
    }
    
    private function returnRange($number_of_columns)
    {
        return array_splice($this->createColumnsArray('ZZ'), 0, $number_of_columns);
        
    }
}