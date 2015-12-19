#!/usr/bin/env bash
/usr/bin/hhvm -v Eval.Jit=1 -v Eval.JitProfileInterpRequests=0 $@
exit 0
