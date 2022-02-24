<?php

    namespace MyProject\Cli;

    class TestCron extends AbstractCommand
    {

        /**
         * @throws \MyProject\Exceptions\CliException
         */
        protected function checkParams()
        {
            $this->ensureParamExists('x');
            $this->ensureParamExists('y');
        }

        public function execute()
        {
            // чтобы проверить работу скрипта, будем записывать в файлик 1.log текущую дату и время
            file_put_contents(
              'D:\\1.log',
              date(DATE_ATOM) . PHP_EOL,
              FILE_APPEND
            );
        }

    }