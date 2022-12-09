# Dynamo-PHP-Hash

## Purpose

For a given string the **hash** function should return a value in the interval [0;360].

```
Hash : String --> Float [0;360]
```

To achieve its goal, the **hash** function will use a given hash function (for example sha256) and hash the input.

From the hashed input, it will transform it to a float in the wanted interval. 

In this implementation, the function will take the X first and Y last characters of the primary hash function's result and 
apply a transformation to obtain a number in the interval.


